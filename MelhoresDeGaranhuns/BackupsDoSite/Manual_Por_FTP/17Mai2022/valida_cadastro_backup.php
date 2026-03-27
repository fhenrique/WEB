<?php
if(session_id() == "")
    session_start();

include_once("classes/funcoes.php");
include_once("classes/email.php");

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;
$confSenha = isset($_POST['conf-senha']) ? $_POST['conf-senha'] : null;

$funcs = new Funcoes();
$conn = $funcs->geraConexao();

//  VERIFICA SE EXISTE ALGUM CAMPO NULO
if($nome != null && $email != null && $senha != null && $confSenha != null){
    
    //VERIFICA SE A SENHA FOI CONFIRMADA CORRETAMENTE
    if($senha == $confSenha){

        //  BUSCA EMAIL NO SISTEMA PARA NÃO HAVER DUPLICIDADE
        $busca_existente = "SELECT * FROM usuarios WHERE email = ?";
        $busca_existente = $conn->prepare($busca_existente);
        $busca_existente->bind_param("s",$email);
        $busca_existente->execute();

        $busca_existente = $busca_existente->get_result();

        //  CASO NÃO HAJA DUPLICIDADE PROSSEGUE COM O CADASTRO
        if($busca_existente->num_rows <= 0){
            $nome = mb_strtolower($nome);   //  DEIXA O NOME EM PADRÃO MINUSCULO
            $hoje = $funcs->hoje(); //  DIA DE HOJE
            $senha = MD5($senha);   //  PASSA O HASH MD5 NA SENHA

            //  REQUISIÇÃO PARA INSERIR O USUÁRIO
            $insere_usuario = "INSERT INTO usuarios (nome,email,senha,cadastro) VALUE (?,?,?,?)";
            $insere_usuario = $conn->prepare($insere_usuario);
            $insere_usuario->bind_param("ssss",$nome,$email,$senha,$hoje);
            
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
                if(envia_email($email,$assunto,$mensagem) === TRUE){
                    header("Location:/login");  //  DIRECIONA PARA TELA DE LOGIN
                }
            }
        }
    }else{

    }

}else{

}
?>
