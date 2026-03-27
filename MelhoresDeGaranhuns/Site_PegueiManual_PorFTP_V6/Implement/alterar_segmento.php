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

$idSegmentoRecebido = isset($_POST['segmento']) ? mb_strtolower($_POST['segmento']) : null;
$segmentoRecebido = isset($_POST['novo-segmento']) ? mb_strtolower($_POST['novo-segmento']) : null;

if($segmentoRecebido != null){
    require_once("classes/segmentos.php");
    require_once("classes/alertas.php");

    $a = new Alertas();
    $segmento = new Segmentos();
    $segmento->setId($idSegmentoRecebido);
    $segmento->setSegmento($segmentoRecebido);

    try{
        $segmento->update();
        $a->add(array("tipo" => "success", "msg" => "Segmento alterado com sucesso."));
    
    } catch (Exception $e){
        $a->add(array("tipo" => "danger", "msg" => $e->getMessage()));
    }

}else{
    $a->add(array("tipo" => "danger", "msg" => "Insira um segmento válido."));
}

$_SESSION['alertas'] = serialize($a);
header("Location:/edicao");