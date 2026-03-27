<?php
if(session_id() == "")
session_start();

if(!isset($_SESSION['userID']))
header("Location:/");

require_once("classes/usuario.php");

$admin = new Usuario();
$admin->setIdExterno($_SESSION['userID']);
$admin->select();

if($admin->getId() != 1)
header("Location:/perfil");

$linkRecebido = isset($_POST['linkImagem']) ? trim($_POST['linkImagem']) : null;

if($linkRecebido != null){
    require_once("classes/alertas.php");
    require_once("classes/imagemCarrossel.php");

    $a = new Alertas();
    $i = new ImagemCarrossel();
    $i->setCaminho($linkRecebido);

    try{
        if($i->insert()){
            $a->add(array("tipo" => "success", "msg" => "Nova Link de Carrossel inserido com sucesso."));
        
        }else{
            $a->add(array("tipo" => "danger", "msg" => "Link já existente."));
        
        }
    
    } catch (Exception $e){
        $a->add(array("tipo" => "danger", "msg" => $e->getMessage()));
    }

}else{
    $a->add(array("tipo" => "danger", "msg" => "Insira um Link válido."));
}

$_SESSION['alertas'] = serialize($a);
header("Location:/carrossel");