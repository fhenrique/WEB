<?php
session_start();

require_once("classes/usuario.php");
require_once("classes/empresa.php");
require_once("classes/alertas.php");
require_once("classes/funcoes.php");

if(!isset($_SESSION['userID']))
header("Location:/");

//  Usuario
$u = new Usuario();
$u->setIdExterno($_SESSION['userID']);
$u->select();

if($u->getId() != 1)
header("Location:/perfil");

//  Alertas
$a = new Alertas();

$prosseguir = TRUE;

$id = isset($_POST['select-del-empresa']) ? ($_POST['select-del-empresa']) : null;
$nome = isset($_POST['confirm-delete-empresa']) ? mb_strtolower($_POST['confirm-delete-empresa']) : null;

$dados = array(
    "id" => $id,
    "nome" => $nome
);

foreach($dados as $k => $v){
    if($v == null){
        $a->add(array("tipo" => "danger", "msg" => "Campo $k inválido"));
        $prosseguir = FALSE;
    }
}

if($prosseguir){
    //  Empresa
    $e = new Empresa();
    $e->setId($id);

    try{
        $e->selectById();
        
        $nome_esperado = "confirmar";//str_replace(" ","-",strtolower($e->getNome()));
        
        if($nome_esperado == $nome){
            $e->delete();
        }
        $a->add(array("tipo" => "success", "msg" => "Empresa excluída."));

    }catch (Exception $e){
        $a->add(array("tipo" => "danger", "msg" => $e->getMessage()));

    }

}

$_SESSION['alertas'] = serialize($a);
header("Location:/edicao");