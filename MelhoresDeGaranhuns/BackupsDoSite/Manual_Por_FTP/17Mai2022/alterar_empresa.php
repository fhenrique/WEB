<?php
session_start();

require_once("classes/usuario.php");
require_once("classes/empresa.php");
require_once("classes/alertas.php");
require_once("classes/segmentos.php");
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

$id = isset($_POST['select-edit-empresa']) ? mb_strtolower($_POST['select-edit-empresa']) : null;
$nome = isset($_POST['nome-edit-empresa']) ? ($_POST['nome-edit-empresa']) : null;
$telefone = isset($_POST['telefone-edit-empresa']) ? $_POST['telefone-edit-empresa'] : null;
$endereco = isset($_POST['endereco-edit-empresa']) ? ($_POST['endereco-edit-empresa']) : null;
$segmento = isset($_POST['segmento-edit-empresa']) ? $_POST['segmento-edit-empresa'] : null;
$descricao = isset($_POST['descricao-edit-empresa']) ? ($_POST['descricao-edit-empresa']) : null;
$link = isset($_POST['link-edit-empresa']) ? ($_POST['link-edit-empresa']) : null;

$dados = array(
    "id" => $id,
    "nome" => $nome,
    "telefone" => $telefone,
    "endereço" => $endereco,
    "segmento" => $segmento,
    "descrição" => $descricao
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
    $e->setNome($nome);
    $e->setTelefone($telefone);
    $e->setEndereco($endereco);
    $e->setSegmento($segmento);
    $e->setDescricao($descricao);
    $e->setLink($link);

    try{
        $e->update();
        $a->add(array("tipo" => "success", "msg" => "Empresa alterada."));

    }catch (Exception $e){
        $a->add(array("tipo" => "danger", "msg" => $e->getMessage()));

    }

}

$_SESSION['alertas'] = serialize($a);
header("Location:/edicao");