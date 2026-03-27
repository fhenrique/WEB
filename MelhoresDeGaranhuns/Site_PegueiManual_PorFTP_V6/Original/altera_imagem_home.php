<?php
session_start();
ini_set('upload_max_filesize', '2M');

$continue = TRUE;

if(!isset($_SESSION['userID']))
$continue = FALSE;

require_once("classes/usuario.php");
require_once("classes/funcoes.php");

$admin = new Usuario();
$admin->setIdExterno($_SESSION['userID']);
$admin->select();

if($admin->getId() != 1)
header("Location:/perfil");

if($continue){
    require_once("classes/alertas.php");
    require_once("classes/imagemCarrossel.php");
    $a = new Alertas();

    $file = $_FILES['imgHome'];

    $caminho = 'images/slider-bg.jpg';

    if(move_uploaded_file($file['tmp_name'],$caminho)){
        $a->add(array("tipo" => "success", "msg" => "Imagem Alterada com sucesso"));
    }else{
        $a->add(array("tipo" => "danger", "msg" => "Não foi possivel fazer o upload da imagem"));
    }

}else{
    $a->add(array("tipo" => "danger", "msg" => "Erro Inesperdado"));

}

$_SESSION['alertas'] = serialize($a);
header("Location:/carrossel");
?>