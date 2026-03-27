<?php
require_once("classes/funcoes.php");

class ImagemCarrossel{
    private $id;
    private $caminho;
    private $ativo;
    private $f;
    private $c;

    public function __construct()
    {
        $this->f = new Funcoes();
        $this->c = $this->f->geraConexao();
    }

    public function selectById()
    {
        try{
            $busca = $this->c->prepare("SELECT * FROM carrossel WHERE id = ?");
            $busca->bind_param("i",$this->id);
            $busca->execute();

            $busca = $busca->get_result();

            if($busca->num_rows > 0)
            {
                $busca = $busca->fetch_assoc();

                $this->caminho = $busca['caminho'];
                $this->ativo = $busca['ativo'];
            }

        } catch (Exception $e)
        {
            throw new Exception("Imagem de carrossel não encontrada.");
        }
    }

    public function selectByCaminho()
    {
        $busca = $this->c->prepare("SELECT * FROM carrossel WHERE caminho = ?");
        $busca->bind_param("s",$this->caminho);
        $busca->execute();

        $busca = $busca->get_result();

        if($busca->num_rows > 0)
        {
            $busca = $busca->fetch_assoc();

            $this->id = $busca['id'];
            $this->ativo = $busca['ativo'];
        }else
        {
            throw new Exception("Imagem de carrossel não encontrada.");
        }

    }

    public function insert()
    {
        try{
            $this->selectByCaminho();

            return FALSE;
        
        } catch(Exception $e)
        {
            $insere = $this->c->prepare("INSERT INTO carrossel (caminho,ativo) VALUES (?,0)");
            $insere->bind_param("s",$this->caminho);

            if($insere->execute() === TRUE)
            {
                return TRUE;
            }else
            {
                throw new Exception("Não foi possivel inserir a imagem de carrossel.");
            }
        }
    }
    
    public function update()
    {
        try{
            $altera = $this->c->prepare("UPDATE carrossel SET ativo = ? WHERE id = ?");
            $altera->bind_param("ii",$this->ativo,$this->id);

            if($altera->execute() === TRUE)
            {
                return TRUE;
            }else{
                throw new Exception("Não foi possivel alterar a imagem de carrossel.");
            }

        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function delete()
    {
        try{
            $this->selectById();

            $del = $this->c->prepare("DELETE FROM carrossel WHERE id = ? AND ativo = ?");
            $del->bind_param("ii",$this->id,$this->ativo);
            
            if($del->execute() === TRUE)
            {
                return TRUE;
            }else
            {
                throw new Exception("Não foi possivel deletar a imagem de carrossel.");
            }

        } catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
   

    /**
     * Get the value of caminho
     */ 
    public function getCaminho()
    {
        return $this->caminho;
    }

    /**
     * Set the value of caminho
     *
     * @return  self
     */ 
    public function setCaminho($caminho)
    {
        $this->caminho = $caminho;

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
     * Get the value of ativo
     */ 
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set the value of ativo
     *
     * @return  self
     */ 
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }
}