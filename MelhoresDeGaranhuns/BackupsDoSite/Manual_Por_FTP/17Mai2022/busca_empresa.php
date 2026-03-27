<?php
require_once("classes/empresa.php");

$idEmpresa = isset($_POST['idEmpresa']) ? $_POST['idEmpresa'] : null;

$r = [];

$e = new Empresa();
$e->setId($idEmpresa);

$r['debug'] = $idEmpresa;

try{
    $e->selectById();
    $r['status'] = "success";
    $r['nome'] = $e->getNome();
    $r['segmento'] = $e->getSegmento()->getId();
    $r['descricao'] = $e->getDescricao();
    $r['endereco'] = $e->getEndereco();
    $r['link'] = $e->getLink();
    $r['logo'] = $e->getImagem();
    $r['telefone'] = $e->getTelefone();

}catch (Exception $erro){
    $r['status'] = "error";
    $r['message'] = $erro->getMessage();
}


echo json_encode($r, JSON_PRETTY_PRINT);