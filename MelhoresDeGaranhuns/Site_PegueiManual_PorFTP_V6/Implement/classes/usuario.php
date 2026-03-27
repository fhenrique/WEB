<?php
include_once("classes/funcoes.php");
include_once("classes/email.php");

class Usuario{
    private $funcs;
    private $conn;
    private $idExterno;
    private $id;
    private $nome;
    private $nomeCompleto;
    private $email;
    private $telefone;

    function __construct(){
        $this->funcs = new Funcoes();
        $this->conn = $this->funcs->geraConexao();

    }

    private function decode_id(){
        if(!isset($this->id))
        {
            $tam = strlen($this->idExterno);
    
            $lugar = -($tam-16);
        
            $real_id = substr($this->idExterno,$lugar);
           
            $tam = strlen($real_id);
        
            $lugar = $tam-16;
           
            $real_id = substr($real_id,0,$lugar);
        
            $this->setId($real_id);
        }
    }

    private function encode_id($id){
        $mix = str_split(substr(MD5($id),0,16));

        shuffle($mix);

        $part1 = implode('',$mix);

        shuffle($mix);

        $part2 = implode('',$mix);

        $this->setIdExterno($part1.$id.$part2);

    }

    public function login($senha){
        $senha = MD5($senha);
        if($this->email != null && $this->email != ""){
            $busca_usuario = "SELECT id FROM usuarios WHERE email = ? AND senha = ?";
            $busca_usuario = $this->conn->prepare($busca_usuario);
            $busca_usuario->bind_param("ss",$this->email, $senha);
            $busca_usuario->execute();
            $busca_usuario = $busca_usuario->get_result();

            if($busca_usuario->num_rows > 0){
                $resultado = $busca_usuario->fetch_assoc();
                $this->encode_id($resultado['id']);
                return TRUE;

            }else{
                $this->setId(0);
                return FALSE;

            }
        }else{
            throw new Exception("Endereço de email inválido.");

        }
    }

    public function select(){
        $this->decode_id();

        if($this->id != null){
            $busca_usuario = "SELECT * FROM usuarios WHERE id = ?";
            $busca_usuario = $this->conn->prepare($busca_usuario);
            $busca_usuario->bind_param("i",$this->id);
            $busca_usuario->execute();
            $busca_usuario = $busca_usuario->get_result();

            if($busca_usuario->num_rows > 0){
                $resultado = $busca_usuario->fetch_assoc();
                $this->setNomeCompleto($resultado['nome']);
                $this->setNome(explode(" ",$resultado['nome'])[0]);
                $this->setTelefone($resultado['telefone']);
                $this->setEmail($resultado['email']);

            }else{
                $this->setNomeCompleto(null);
                $this->setNome(null);
                $this->setTelefone(null);
                $this->setEmail(null);

            }

        }else{
            throw new Exception("ID inválido");

        }

    }

    public function insert($senha,$confSenha){
        //  VERIFICA SE EXISTE ALGUM CAMPO NULO
        if($this->nomeCompleto != null && $this->telefone != null && $this->email != null && $senha != null && $confSenha != null){
            //VERIFICA SE A SENHA FOI CONFIRMADA CORRETAMENTE
            if($senha == $confSenha){

                //  BUSCA EMAIL NO SISTEMA PARA NÃO HAVER DUPLICIDADE
                $busca_existente = "SELECT * FROM usuarios WHERE email = ?";
                $busca_existente = $this->conn->prepare($busca_existente);
                $busca_existente->bind_param("s",$this->email);
                $busca_existente->execute();

                $busca_existente = $busca_existente->get_result();

                //  CASO NÃO HAJA DUPLICIDADE PROSSEGUE COM O CADASTRO
                if($busca_existente->num_rows <= 0){
                    $nome = mb_strtolower($this->nomeCompleto);   //  DEIXA O NOME EM PADRÃO MINUSCULO
                    $hoje = $this->funcs->hoje(); //  DIA DE HOJE

                    //  REQUISIÇÃO PARA INSERIR O USUÁRIO
                    $insere_usuario = "INSERT INTO usuarios (nome,telefone,email,senha,cadastro) VALUE (?,?,?,?,?)";
                    $insere_usuario = $this->conn->prepare($insere_usuario);
                    $insere_usuario->bind_param("sssss",$nome,$this->telefone,$this->email,$senha,$hoje);
                    
                    //  CASO SEJA BEM SUCEDIDA
                    if($insere_usuario->execute() == TRUE){

                        //  PREPARA O EMAIL DE BOAS VINDAS A SER ENVIADO
                        //  ASSUNTO DO EMAIL
                        $assunto = "Bem vindo(a)";

                        //  CORPO DO EMAIL
                        $mensagem = "<p style='font-size: 18px;margin-top:25px;font-family:Arial'>Seja bem-vindo(a) aos Melhores de Garanhuns, <b style='color:#4169E1'>".ucwords($nome)."!</b><br> 

                        Aqui a sua avaliação faz a diferença. <br>

                        Clique em: <a href='www.ysrael-dev.com/sistema-ranking/login.html'>Comece a avaliar.</a><br>

                        Atenciosamente,

                        Equipe Melhores de Garanhuns</p>";

                        //  CASO O EMAIL SEJA ENVIADO CORRETAMENTE
                        if(envia_email($this->email,$assunto,$mensagem) === TRUE){
                            return TRUE;

                        }else{
                            throw new Exception("Falha ao inserir usuário.");

                        }

                    }

                }else{
                    throw new Exception("Endereço de email já cadastrado.");

                }

            }else{
                throw new Exception("As senhas não coincidem.");

            }

        }else{
            throw new Exception("Existem campos com dados invalidos.");

        }

    }

    public function update(){
        $this->decode_id();

        if($this->id != null && $this->id != "" && $this->id != 0){
            $atualiza = "UPDATE usuarios SET nome = ?, telefone = ? WHERE id = ?";
            $atualiza = $this->conn->prepare($atualiza);
            $atualiza->bind_param("ssi",$this->nomeCompleto,$this->telefone,$this->id);

            if($atualiza->execute() === TRUE){
                return TRUE;
            
            }else{
                throw new Exception("Erro ao atualizar usuário.");

            }

        }else{
            throw new Exception("ID inválido");

        }

    }

    public function updateSenha($novaSenha, $confNovaSenha){
        if($novaSenha == $confNovaSenha){
            $novaSenha = MD5($novaSenha);
            $this->decode_id();

            if($this->id != null && $this->id != "" && $this->id != 0){
                $atualiza = "UPDATE usuarios SET senha = ? WHERE id = ?";
                $atualiza = $this->conn->prepare($atualiza);
                $atualiza->bind_param("si",$novaSenha,$this->id);

                if($atualiza->execute() === TRUE){
                    //  PREPARA O EMAIL DE BOAS VINDAS A SER ENVIADO
                    //  ASSUNTO DO EMAIL
                    $assunto = "Alteração de Senha";

                    //  CORPO DO EMAIL
                    $mensagem = "<p style='font-size: 14px;margin-top:25px;font-family:Arial'>Olá, <b style='color:#4169E1'>".ucwords($this->nome)."!</b><br> 
                    Sua senha foi alterada com sucesso. <br>
                    Acesse: <a href='www.ysrael-dev.com/sistema-ranking/login.html'>Melhores de Garanhuns.</a><br>
                    Atenciosamente,
                    Equipe Melhores de Garanhuns</p>";

                    //  CASO O EMAIL SEJA ENVIADO CORRETAMENTE
                    if(envia_email($this->email,$assunto,$mensagem) === TRUE){
                        return TRUE;

                    }else{
                        throw new Exception("Falha ao enviar email.");

                    }

                    return TRUE;
                
                }else{
                    throw new Exception("Erro ao atualizar usuário.");

                }

            }else{
                throw new Exception("ID inválido");

            }

        }

    }

    public function delete(){
        if($this->id != null && $this->id != "" && $this->id != 0){
            $deletar = "DELETE FROM usuarios WHERE id = ? AND email = ?";
            $deletar = $this->conn->prepare($deletar);
            $deletar->bind_param("is",$this->id, $this->email);

            if($deletar->execute() === TRUE){
                return TRUE;

            }else{
                throw new Exception("Erro ao deletar usuário.");

            }
        
        }else{
            throw new Exception("ID inválido");

        }
    }

    /**
     * Área dos Getters e Setters
     */

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of idExterno
     */ 
    public function getIdExterno()
    {
        return $this->idExterno;
    }

    /**
     * Set the value of idExterno
     *
     * @return  self
     */ 
    public function setIdExterno($idExterno)
    {
        $this->idExterno = $idExterno;

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of nomeCompleto
     */ 
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    /**
     * Set the value of nomeCompleto
     *
     * @return  self
     */ 
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;

        return $this;
    }
}

?>