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

$idCarrosselRecebido = isset($_POST['idImg']) ? trim($_POST['idImg']) : null;
$statusCarrosselRecebido = isset($_POST['status']) ? trim($_POST['status']) : null;

if($idCarrosselRecebido != null){
    require_once("classes/imagemCarrossel.php");
    require_once("classes/alertas.php");

    $a = new Alertas();
    $i = new ImagemCarrossel();
    $i->setId($idCarrosselRecebido);
    $i->setAtivo($statusCarrosselRecebido);

    try{
        $i->update();
        $a->add(array("tipo" => "success", "msg" => "Imagem Carrossel alterado com sucesso."));
    
    } catch (Exception $e){
        $a->add(array("tipo" => "danger", "msg" => $e->getMessage()));
    }

}else{
    $a->add(array("tipo" => "danger", "msg" => "Insira status de Imagem válido."));
}

$_SESSION['alertas'] = serialize($a);
header("Location:/carrossel");