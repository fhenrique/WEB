<?php
session_start();
ini_set('upload_max_filesize', '2M');

$continue = TRUE;

if(!isset($_SESSION['userID']))
$continue = FALSE;

require_once("classes/usuario.php");
require_once("classes/funcoes.php");

$u = new Usuario();
$u->setIdExterno($_SESSION['userID']);
$u->select();

if($u->getId() != 1)
$continue = FALSE;

if($continue){
    $f = new Funcoes();
    $c = $f->geraConexao();

    $file = $_FILES['file'];

    $ret = [];
    $extensao = explode(".",$file['name']);
    $extensao = $extensao[count($extensao)-1];

    $nome = MD5(Date('Y-m-d H:i:s'));
    $novo_nome = $nome.".".$extensao;
    $caminho = 'uploads/'.$novo_nome;

    if(move_uploaded_file($file['tmp_name'],$caminho)){
        $addLogo = $c->prepare("INSERT INTO imagens (titulo,caminho,data_upload) VALUES (?,?,?)");
        $addLogo->bind_param("sss",$file['name'],$caminho,$f->hoje());

        if($addLogo->execute() === TRUE){
            $ret["status"] = "success";
            $ret["path"] = $caminho;
            $ret["name"] = $file['name'];
            $ret["id"] = $nome;

        }else{
            $ret["status"] = "error";
            $ret["name"] = $file['name'];

        }
        
    }else{
        $ret["status"] = "error";
        $ret["name"] = $file['name'];
    }

}else{
    $ret["status"] = "error";

}

echo json_encode($ret, JSON_PRETTY_PRINT);
?>