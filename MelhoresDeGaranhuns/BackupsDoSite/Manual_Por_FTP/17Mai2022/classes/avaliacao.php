<?php
require_once("classes/empresa.php");
require_once("classes/funcoes.php");
require_once("classes/usuario.php");

class Avaliacao{
    private $f;
    private $c;
    private $id;
    private $pontos;
    public $empresa;
    public $autor;
    
    public function __construct()
    {
        $this->f = new Funcoes();
        $this->c = $this->f->geraConexao();
        $this->empresa = new Empresa();
        $this->autor = new Usuario();
        $this->pontos = null;
    }
    
    public function select()
    {
        $emp = $this->empresa->getId();
        $user = $this->autor->getId();
        $busca = $this->c->prepare("SELECT * FROM avaliacoes WHERE id_empresa = ? AND id_usuario = ?");
        $busca->bind_param("ii",$emp,$user);
        $busca->execute();
        
        $resultado = $busca->get_result();
        
        if($resultado->num_rows > 0)
        {
            $resultado = $resultado->fetch_assoc();
            
            $this->id = $resultado['id'];
            $this->pontos = $resultado['pontuacao'];
            
            return TRUE;
        
        }else
        {
        
            throw new Exception("Avaliação não encontrada");
        
        }
    }
    
    public function selectById()
    {
        $busca = $this->c->prepare("SELECT * FROM avaliacoes WHERE id = ?");
        $busca->bind_param("i",$this->id);
        $busca->execute();
        
        $resultado = $busca->get_result();
        
        if($resultado->num_rows > 0)
        {
            $resultado = $resultado->fetch_assoc();
            $this->pontos = $resultado['pontuacao'];
            
            $this->empresa->setId($resultado['id_empresa']);
            $this->empresa->selectById();
            
            $this->autor->setId($resultado['id_usuario']);
            $this->autor->select();
            
            return TRUE;
            
        }else
        {
            throw new Exception("Avaliação não encontrada.");
        }
    }
    
    public function insert()
    {
        $id_empresa = $this->empresa->getId();
        $id_segmento = $this->empresa->getSegmento()->getId();
        $id_usuario = $this->autor->getId();
        $data_avaliacao = $this->f->hoje();
        
        $insere = $this->c->prepare("INSERT INTO avaliacoes (id_empresa,id_segmento,id_usuario,pontuacao,data_avaliacao) VALUES (?,?,?,?,?)");
        $insere->bind_param("iiiis",$id_empresa,$id_segmento,$id_usuario,$this->pontos,$data_avaliacao);
        
        if($insere->execute() === TRUE)
        {
            return TRUE;
        }else
        {
            throw new Exception("Avaliação não inserida.");
        }
    }
    
    public function update()
    {
        $id_segmento = $this->empresa->getSegmento()->getId();
        $edit = $this->c->prepare("UPDATE avaliacoes SET pontuacao = ?, id_segmento = ? WHERE id = ?");
        $edit->bind_param("iii",$this->pontos,$id_segmento,$this->id);
        
        if($edit->execute() === TRUE)
        {
            return TRUE;
        }else
        {
            throw new Exception("Avaliação não alterada.");
        }
    }
    
    public function delete()
    {
    
    }
    
    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
        
        return $this;
    }
    
    public function getPontos()
    {
        return $this->pontos;
    }
    
    public function setEmpresa($empresa)
    {
        if(!isset($this->empresa))
        {
            $this->empresa = $empresa;
        }
        
        return $this;
    }
    
    
    public function getEmpresa()
    {
        return $this->empresa;
    }
    
    public function setAutor($autor)
    {
        if(!isset($this->autor)){
            $this->autor = $autor;
        }
    }
    
    public function getAutor()
    {
        return $this->autor;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }
}