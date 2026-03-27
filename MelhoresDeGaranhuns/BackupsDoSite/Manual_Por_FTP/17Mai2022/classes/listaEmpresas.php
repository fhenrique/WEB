<?php
require_once("classes/empresa.php");
require_once("classes/funcoes.php");

class ListaEmpresas{
    private $f;
    private $c;
    private $lista;

    public function __construct(){
        $this->f = new Funcoes();
        $this->c = $this->f->geraConexao();
        $this->lista = [];

        $this->setLista();
    }

    public function ordenar()
    {
        $mudou = TRUE;
        
        while($mudou)
        {
            $mudou = FALSE;
            for($i = 0; $i < count($this->lista); $i++)
            {
                if(isset($this->lista[$i+1]))
                {
                    if($this->lista[$i]->getPontos() < $this->lista[$i+1]->getPontos())
                    {
                        $aux = $this->lista[$i];
                        $this->lista[$i] = $this->lista[$i+1];
                        $this->lista[$i+1] = $aux;

                        $mudou = TRUE;
                    }
                }
            }
        }
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
            $busca = $this->c->query("SELECT * FROM empresas Order by nome asc");
        }else
        {
            $busca = $this->c->query("SELECT * FROM empresas Order by nome asc LIMIT 0,".$limite);
        }
        
        if($busca->num_rows > 0){

            while($row = $busca->fetch_assoc()){
                $empresaTemp = new Empresa();
                $empresaTemp->setId($row['id']);
                $empresaTemp->setNome($row['nome']);
                $empresaTemp->setDescricao($row['descricao']);
                $empresaTemp->setImagem($row['logo']);
                $empresaTemp->setSegmento($row['id_segmento']);
                $empresaTemp->setEndereco($row['endereco']);
                $empresaTemp->setLink($row['link']);
                $empresaTemp->setTelefone($row['telefone']);
                $empresaTemp->setCadastro($row['data_cadastro']);
                $empresaTemp->buscaPontos();
                $empresaTemp->buscaQtdAval();

                $this->lista[] = $empresaTemp;

            }

        }

    }

    public function setListaBySegmento($seg,$limite=null)
    {
        $this->lista = array();
        if($limite == null)
        {
            $busca = $this->c->query("SELECT * FROM empresas WHERE id_segmento = $seg order by nome asc");
        }else
        {
            $busca = $this->c->query("SELECT * FROM empresas WHERE id_segmento = $seg order by nome asc LIMIT 0,".$limite);
        }
        
        if($busca->num_rows > 0){

            while($row = $busca->fetch_assoc()){
                $empresaTemp = new Empresa();
                $empresaTemp->setId($row['id']);
                $empresaTemp->setNome($row['nome']);
                $empresaTemp->setDescricao($row['descricao']);
                $empresaTemp->setImagem($row['logo']);
                $empresaTemp->setSegmento($row['id_segmento']);
                $empresaTemp->setEndereco($row['endereco']);
                $empresaTemp->setTelefone($row['telefone']);
                $empresaTemp->setCadastro($row['data_cadastro']);
                $empresaTemp->buscaPontos();
                $empresaTemp->buscaQtdAval();

                $this->lista[] = $empresaTemp;

            }

        }

    }

}