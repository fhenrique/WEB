<?php
class Alertas{
    public $alertas = [];

    public function limpaAlertas(){
        $this->alertas = [];
    }

    public function exibeAlertas(){
        if(count($this->alertas) > 0){
            echo "<div class=\"card-body\">";
            foreach($this->alertas as $alerta){
                echo "<div class=\"alert alert-".$alerta['tipo']." color-".$alerta['tipo']."\">".$alerta['msg']."</div>";
            }
            echo "</div>";
            $this->limpaAlertas();
        }
    }

    /**
     * Get the value of alertas
     */ 
    public function getAlertas()
    {
        return $this->alertas;
    }

    /**
     * Set the value of alertas
     *
     * @return  self
     */ 
    public function add($alertas)
    {
        $this->alertas[] = $alertas;

        return $this;
    }
}
?>