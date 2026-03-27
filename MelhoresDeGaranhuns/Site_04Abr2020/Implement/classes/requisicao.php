<?php

class Requisicao{
    private $drive = 'mysql';
    private $dbhost = '108.179.192.90';
    private $dbname = 'ysrael75_srank';
    private $dbuser = 'ysrael75_admin';
    private $dbpass = 'learsy10';

    public function query($sql, $dados=null){
        try{
            //  PREPARA A CONEXÃO PDO
            $conn = new \PDO($this->drive.': host='.$this->dbhost.'; dbname='.$this->dbname, $this->dbuser, $this->dbpass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //  PREPARA A REQUISIÇÃO SQL
            $stmt = $conn->prepare($sql);

            //  SE HOUVER DADOS PARA PASSAR, ITERA OS DADOS
            if(count($dados) > 0){
                foreach($dados as $k => $v){
                    $stmt->bind_value($k,$v);
                }
            }

            //  EXECUTA A REQUISIÇÃO
            $stmt->execute();

            //  VERIFICA SE A REQUISIÇÃO FOI EXECUTADA CORRETAMENTE
            if($stmt->rowCount() > 0){
                return "Executado com Sucesso!";
            }else{
                return "Sem resultados.";
            }

        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    }
}

$select = new Requisicao();
echo $select->query("SELECT * FROM usuarios");

?>