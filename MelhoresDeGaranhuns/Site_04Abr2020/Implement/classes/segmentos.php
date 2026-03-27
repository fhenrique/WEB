<?php
require_once("classes/funcoes.php");

class Segmentos{
    private $f;
    private $c;
    private $id;
    private $segmento;
    private $listaSegmentos;

    public function __construct(){
        $this->f = new Funcoes();
        $this->c = $this->f->geraConexao();
        $listaSegmentos = [];

    }

    public function allSegmentos(){
        try{
            $busca = $this->c->prepare("SELECT * FROM segmentos");
            $busca->execute();

            $busca = $busca->get_result();

            if($busca->num_rows > 0){
                foreach($busca as $seg){
                    $this->listaSegmentos[] = $seg;
                    
                }

            }
        } catch (Exception $e){
            throw new Exception("Nenhum segmento encontrado.");

        }

    }

    public function select(){
        $busca = $this->c->prepare("SELECT * FROM segmentos WHERE nome = ?");
        $busca->bind_param("s",$this->segmento);
        $busca->execute();

        $busca = $busca->get_result();

        if($busca->num_rows > 0){
            $resultado = $busca->fetch_assoc();
            $this->id = $resultado['id'];
        
        }else{
            throw new Exception("Segmento não encontrado");

        }
    }

    public function selectById(){
        $busca = $this->c->prepare("SELECT * FROM segmentos WHERE id = ?");
        $busca->bind_param("i",$this->id);
        $busca->execute();

        $busca = $busca->get_result();

        if($busca->num_rows > 0){
            $resultado = $busca->fetch_assoc();
            $this->segmento = $resultado['nome'];
        
        }else{
            throw new Exception("Segmento não encontrado");

        }
    }

    public function insert(){
        $hoje = $this->f->hoje();

        try{
            $this->select();

            return FALSE;

        }catch (Exception $e){
            $inserir = $this->c->prepare("INSERT INTO segmentos (nome,data_cadastro) VALUES (?,?)");
            $inserir->bind_param("ss",$this->segmento,$hoje);
    
            if($inserir->execute() === TRUE){
                return TRUE;
    
            }else{
                throw new Exception("Segmento não inserido.");
    
            }

        }

    }

    public function update(){
        try{
            $atualiza = $this->c->prepare("UPDATE segmentos SET nome = ? WHERE id = ?");
            $atualiza->bind_param("si",$this->segmento,$this->id);

            if($atualiza->execute() === TRUE){
                return TRUE;

            }else{
                throw new Exception("Erro ao atualizar segmento.");

            }

        } catch (Exception $e){
            return $e;

        }

    }

    public function delete(){
        try{
            $this->select();
            $exclui = $this->c->prepare("DELETE FROM segmentos WHERE id = ? AND nome = ?");
            $exclui->bind_param("is", $this->id, $this->nome);

            if($exclui->execute() === TRUE){
                return TRUE;
            
            }else{
                throw new Exception("Erro ao excluir segmento.");

            }

        } catch (Exception $e){
            return $e;

        }

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
        $this->segmento = $segmento;

        return $this;
    }

    /**
     * Get the value of listaSegmentos
     */ 
    public function getListaSegmentos()
    {
        return $this->listaSegmentos;
    }

    /**
     * Set the value of listaSegmentos
     *
     * @return  self
     */ 
    public function setListaSegmentos($listaSegmentos)
    {
        $this->listaSegmentos = $listaSegmentos;

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
}