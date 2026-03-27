<?php
require_once("classes/avaliacao.php");
require_once("classes/empresa.php");
require_once("classes/funcoes.php");

class ListaAvaliacoes{
    private $f;
    private $c;
    private $idUsuario;
    private $lista;
    private $listaExcecao;
    private $empresasAvaliadas;

    public function __construct(){
        $this->f = new Funcoes();
        $this->c = $this->f->geraConexao();
        $this->lista = array();
        $this->listaExcecao = array();
        $this->empresasAvaliadas = array(0);
    }
    
    /**
     * Get the value of lista
     */ 
    public function getLista()
    {
        $this->setLista();
        return $this->lista;
    }

    /**
     * Set the value of lista
     *
     * @return  self
     */ 
    public function setLista()
    {
        $busca = $this->c->prepare("SELECT * FROM avaliacoes WHERE id_usuario = ?");
        $busca->bind_param("i",$this->idUsuario);
        $busca->execute();
        
        $resultado = $busca->get_result();
        
        if($resultado->num_rows > 0)
        {
            $this->lista = array();
            foreach($resultado as $row)
            {
                $avaliacao = new Avaliacao();
                $avaliacao->setId($row['id']);
                $avaliacao->selectById();

                $this->lista[] = $avaliacao;

                $this->empresasAvaliadas[] = $avaliacao->empresa->getId();

            }

        }

    }
    
    /**
     * Get the value of listaExcecao
     */ 
    public function getListaExcecao()
    {
        $this->setListaExcecao();
        return $this->listaExcecao;
    }

    public function setListaExcecao()
    {
        $separador = implode(",",$this->empresasAvaliadas);
        $busca = $this->c->prepare("SELECT * FROM empresas WHERE id NOT IN ($separador)");
        $busca->execute();
        
        $resultado = $busca->get_result();
        
        if($resultado->num_rows > 0)
        {
            $this->listaExcecao = array();
            foreach($resultado as $row)
            {
                $empresa = new Empresa();
                $empresa->setId($row['id']);
                $empresa->selectById();

                $this->listaExcecao[] = $empresa;

            }

        }

    }
    
    /**
     * Get the value of lista
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of lista
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
}
