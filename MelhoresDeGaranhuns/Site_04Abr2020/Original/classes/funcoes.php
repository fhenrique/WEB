<?php

class Funcoes{
    private static $conn;
    //  RETORNA O DIA DE HOJE
    public static function hoje($modelo="db"){
        $timezone = new DateTimeZone('America/Sao_Paulo');

        $hoje = new DateTime('now',$timezone);

        if($modelo == "show"){
            $data_atual = $hoje->format('d/m/Y');
        }else{
            $data_atual = $hoje->format('Y-m-d');
        }

        return $data_atual;
    }

    public static function geraConexao(){
        if(!isset(self::$conn))
        {
            try
            {
                $host = "108.167.132.244";
                $database = "melho972_ranking";
                $usuario = "melho972_admin";
                $senha = "learsy10";
        
                self::$conn = new mysqli($host,$usuario,$senha,$database);   
            }catch (Exception $e)
            {
                echo "Erro: ".$e->getMessage();
            }
        }

        return self::$conn;
    }

    public function valida_email($email){

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    
            return FALSE;
    
        }
    
        return TRUE;
    
    }

    public function exibeAlertas(){
        if(session_id() == "")
            session_start();
        
        if(isset($_SESSION['alertas'])){
            require_once("classes/alertas.php");
            $alertas = unserialize($_SESSION['alertas']);
            $alertas->exibeAlertas();
            unset($_SESSION['alertas']);
        }
    }
}
?>