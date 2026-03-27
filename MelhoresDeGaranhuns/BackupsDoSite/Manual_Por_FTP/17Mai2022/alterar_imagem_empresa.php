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

require_once("classes/alertas.php");
$a = new Alertas();

if($admin->getId() != 1)
header("Location:/perfil");

$id_empresa = isset($_POST['select-edit-logo-empresa']) ? mb_strtolower($_POST['select-edit-logo-empresa']) : null;

if($id_empresa <= 0){
    $continue = FALSE;
    $a->add(array("tipo" => "danger", "msg" => "Empresa inválida."));
}

if($continue){
    $file = $_FILES['logo'];

    $extensao = explode(".",$file['name']);
    $extensao = $extensao[count($extensao)-1];

    $nome = MD5(Date('Y-m-d H:i:s'));
    $novo_nome = $nome.".".$extensao;
    $caminho = 'uploads/carrossel/'.$novo_nome;

    if(move_uploaded_file($file['tmp_name'],$caminho)){
        require_once("classes/empresa.php");
        $e = new Empresa();
        $e->setId($id_empresa);
        $e->selectById();
        $e->setImagem($caminho);
        
        try{
            if($e->updateLogo()){
                $a->add(array("tipo" => "success", "msg" => "Logo alterado com sucesso."));
            
            }else{
                $a->add(array("tipo" => "danger", "msg" => "Erro ao alterar logo."));
            
            }
        
        } catch (Exception $e){
            $a->add(array("tipo" => "danger", "msg" => $e->getMessage()));
        }
        
    }else{
        $a->add(array("tipo" => "danger", "msg" => "Não foi possivel fazer o upload da imagem"));
    }

}else{
    $a->add(array("tipo" => "danger", "msg" => "Erro Inesperdado"));

}

$_SESSION['alertas'] = serialize($a);
header("Location:/edicao");
?>