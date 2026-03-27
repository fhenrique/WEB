<?php
require_once("classes/imagemCarrossel.php");
require_once("classes/funcoes.php");

class Carrossel{
    private $f;
    private $c;
    private $lista;

    public function __construct(){
        $this->f = new Funcoes();
        $this->c = $this->f->geraConexao();
        $this->lista = [];

        $this->setLista();
    }
    
    /**
     * Get the value of lista
     */ 
    public function getLista()
    {
        return $this->lista;
    }

    /**
     * Set the value of lista
     *
     * @return  self
     */ 
    public function setLista($limite=null)
    {
        $this->lista = array();
        if($limite == null)
        {
            $busca = $this->c->query("SELECT * FROM carrossel");
        }else
        {
            $busca = $this->c->query("SELECT * FROM carrossel LIMIT 0,".$limite);
        }
        
        if($busca->num_rows > 0){

            while($row = $busca->fetch_assoc()){
                $imagemTemp = new ImagemCarrossel();
                $imagemTemp->setId($row['id']);
                $imagemTemp->setCaminho($row['caminho']);
                $imagemTemp->setAtivo($row['ativo']);

                $this->lista[] = $imagemTemp;

            }

        }

    }

}