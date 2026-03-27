<?php
require_once("classes/funcoes.php");
require_once("classes/segmentos.php");

class Empresa{
    //Propriedades
    private $f;
    private $c;
    private $id;
    private $nome;
    private $segmento;
    private $descricao;
    private $endereco;
    private $telefone;
    private $imagem;
    private $link;
    private $cadastro;
    private $pontos;
    private $nAvaliacoes;

    //Construtor
    function __construct(){
        $this->f = new Funcoes();
        $this->c = $this->f->geraConexao();
        $this->segmento = new Segmentos();
    }
    
    public function buscaPontos()
    {
        $busca = $this->c->prepare("SELECT (SUM(pontuacao)/COUNT(pontuacao)) as 'pontos' FROM avaliacoes WHERE id_empresa = ?");
        $busca->bind_param("i",$this->id);
        $busca->execute();
        
        $resultado = $busca->get_result();
        
        if($resultado->num_rows > 0)
        {
            $resultado = $resultado->fetch_assoc();
            $this->setPontos(round($resultado['pontos'],2));
        }else
        {
            $this->setPontos(0);
        }
    }

    public function buscaQtdAval()
    {
        $busca = $this->c->prepare("SELECT COUNT(pontuacao) as 'avals' FROM avaliacoes WHERE id_empresa = ?");
        $busca->bind_param("i",$this->id);
        $busca->execute();
        
        $resultado = $busca->get_result();
        
        if($resultado->num_rows > 0)
        {
            $resultado = $resultado->fetch_assoc();
            $this->setNAvaliacoes($resultado['avals']);
        }else
        {
            $this->setNAvaliacoes(0);
        }
    }

    public function selectById(){
        $busca = $this->c->prepare("SELECT * FROM empresas WHERE id = ?");
        $busca->bind_param("i", $this->id);
        $busca->execute();
        $busca = $busca->get_result();

        if($busca->num_rows > 0){
            $busca = $busca->fetch_assoc();

            $this->setNome($busca['nome']);
            $this->setSegmento($busca['id_segmento']);
            $this->setDescricao($busca['descricao']);
            $this->setEndereco($busca['endereco']);
            $this->setImagem($busca['logo']);
            $this->setLink($busca['link']);
            $this->setTelefone($busca['telefone']);
            $this->setCadastro($busca['data_cadastro']);
            $this->buscaPontos();
            $this->buscaQtdAval();

        }else{
            throw new Exception("Empresa não encontrada");

        }

    }

    public function selectByNome(){
        $busca = $this->c->prepare("SELECT * FROM empresas WHERE nome = ?");
        $busca->bind_param("s", $this->nome);
        $busca->execute();
        $busca = $busca->get_result();

        if($busca->num_rows > 0){
            $busca = $busca->fetch_assoc();

            $this->setId($busca['id']);
            $this->setSegmento($busca['id_segmento']);
            $this->setDescricao($busca['descricao']);
            $this->setEndereco($busca['endereco']);
            $this->setImagem($busca['logo']);
            $this->setLink($busca['link']);
            $this->setTelefone($busca['telefone']);
            $this->setCadastro($busca['data_cadastro']);
            $this->buscaPontos();
            $this->buscaQtdAval();

        }else{
            throw new Exception("Empresa não encontrada");

        }

    }

    private function selectByNomeESegmento(){
        $busca = $this->c->prepare("SELECT * FROM empresas WHERE nome = ? and id_segmento = ?");
        $busca->bind_param("si", $this->nome, $this->segmento->getId());
        $busca->execute();
        $busca = $busca->get_result();

        if($busca->num_rows > 0){
            $busca = $busca->fetch_assoc();

            $this->setId($busca['id']);
            $this->setDescricao($busca['descricao']);
            $this->setEndereco($busca['endereco']);
            $this->setImagem($busca['logo']);
            $this->setLink($busca['link']);
            $this->setTelefone($busca['telefone']);
            $this->setCadastro($busca['data_cadastro']);
            $this->buscaPontos();
            $this->buscaQtdAval();

        }else{
            throw new Exception("Empresa não encontrada");

        }

    }

    public function insert(){
        try{
            $this->selectByNomeESegmento();
            return FALSE;
        
        } catch (Exception $e){
            $hoje = $this->f->hoje();
            $insere = $this->c->prepare("INSERT INTO empresas (nome,descricao,logo,link,id_segmento,endereco,telefone,data_cadastro) VALUES (?,?,?,?,?,?,?,?)");
            $insere->bind_param("ssssisss",$this->nome,$this->descricao,$this->imagem,$this->link,$this->segmento,$this->endereco,$this->telefone,$hoje);
            
            if($insere->execute() === TRUE){
                return TRUE;

            }else{
                throw new Exception("Empresa não inserida");

            }

        }
    }

    public function update(){
        try{
            $atualiza = "UPDATE empresas SET nome = ?, descricao = ?, link = ?, id_segmento = ?, endereco = ?, telefone = ? WHERE id = ?";
            $atualiza = $this->c->prepare($atualiza);
            $atualiza->bind_param("sssissi",$this->nome,$this->descricao,$this->link,$this->segmento->getId(),$this->endereco,$this->telefone,$this->id);

            if($atualiza->execute() === TRUE){
                return TRUE;
            
            }else{
                throw new Exception("Erro ao atualizar usuário.");

            }
        
        }catch (Exception $e){
            throw new Exception("Empresa não alterada.");
        }

    }
    
    public function updateLogo(){
        try{
            $atualiza = "UPDATE empresas SET logo = ? WHERE id = ?";
            $atualiza = $this->c->prepare($atualiza);
            $atualiza->bind_param("si",$this->imagem,$this->id);

            if($atualiza->execute() === TRUE){
                return TRUE;
            
            }else{
                throw new Exception("Erro ao atualizar logo.");

            }
        
        }catch (Exception $e){
            throw new Exception("Empresa não alterada.");
        }

    }

    public function delete(){
        $del = "DELETE FROM empresas WHERE id = ?";
        $del = $this->c->prepare($del);
        $del->bind_param("i", $this->id);
        
        if($del->execute() === true)
        {
            return true;
        }
        
        return false;
    }

    //Metodos Basicos
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
     * Get the value of segmento
     */ 
    public function getSegmento()
    {
        return $this->segmento;
    }

    /**
     * Set the value of segmento
     *
     * @return  self
     */ 
    public function setSegmento($segmento)
    {
        $this->segmento->setId($segmento);
        $this->segmento->selectById();

        return $this;
    }

    /**
     * Get the value of endereco
     */ 
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */ 
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

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
     * Get the value of pontos
     */ 
    public function getPontos()
    {
        return $this->pontos;
    }

    /**
     * Set the value of pontos
     *
     * @return  self
     */ 
    public function setPontos($pontos)
    {
        if($pontos == null || $pontos < 0){
            $pontos = 0;
        }
        
        $this->pontos = $pontos;

        return $this;
    }

    /**
     * Get the value of imagem
     */ 
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of cadastro
     */ 
    public function getCadastro()
    {
        return $this->cadastro;
    }

    /**
     * Set the value of cadastro
     *
     * @return  self
     */ 
    public function setCadastro($cadastro)
    {
        $this->cadastro = $cadastro;

        return $this;
    }

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
     * Get the value of nAvaliacoes
     */ 
    public function getNAvaliacoes()
    {
        return $this->nAvaliacoes;
    }

    /**
     * Set the value of nAvaliacoes
     *
     * @return  self
     */ 
    public function setNAvaliacoes($nAvaliacoes)
    {
        $this->nAvaliacoes = $nAvaliacoes;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }
}
?>