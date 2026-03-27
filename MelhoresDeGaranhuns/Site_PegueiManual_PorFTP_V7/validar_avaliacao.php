<?php
session_start();

require_once("classes/usuario.php");
require_once("classes/empresa.php");
require_once("classes/alertas.php");
require_once("classes/segmentos.php");
require_once("classes/funcoes.php");
require_once("classes/avaliacao.php");

if(!isset($_SESSION['userID']))
header("Location:/");

//  Usuario
$u = new Usuario();
$u->setIdExterno($_SESSION['userID']);
$u->select();

//  Alertas
$a = new Alertas();

$prosseguir = TRUE;

$idEmpresa = isset($_POST['empresaRate']) && !empty($_POST['empresaRate']) ? $_POST['empresaRate'] : null;
$estrelas = isset($_POST['estrelas']) && !empty($_POST['estrelas']) ? str_replace("s","",$_POST['estrelas']) : null;
$origem = isset($_POST['origem']) && !empty($_POST['origem']) ? $_POST['origem'] : "home";

if($idEmpresa == null)
{
    $a->add(array("tipo" => "danger", "msg" => "<b>Empresa Inválida</b>"));
    $prosseguir = FALSE;
}

if($estrelas == null || $estrelas < 1 || $estrelas > 5)
{
    $a->add(array("tipo" => "danger", "msg" => "<b>Insira uma nota válida</b>."));
    $prosseguir = FALSE;
}

if($prosseguir)
{
    $rate = new Avaliacao();
    $rate->empresa->setId($idEmpresa);
    $rate->empresa->selectById();
    
    $rate->autor->setId($u->getId());
    $rate->autor->select();
    
    try
    {
        
        $rate->select();
        $rate->setPontos($estrelas);
        $rate->update();
        $a->add(array("tipo" => "success", "msg" => "Você alterou sua avaliação <b>".ucwords($rate->empresa->getNome())."</b> com <b>".$estrelas."</b> estrelas."));
    
        
    }catch (Exception $e)
    {
        try
        {
            $rate->setPontos($estrelas);
            $rate->insert();
            $a->add(array("tipo" => "success", "msg" => "Você avaliou <b>".ucwords($rate->empresa->getNome())."</b> com <b>".$estrelas."</b> estrelas."));
            
        } catch (Exception $erro)
        {
            $a->add(array("tipo" => "danger", "msg" => $erro->getMessage()));    
        }
        
    }
    
    
}

$_SESSION['alertas'] = serialize($a);
header("Location:/$origem#container-empresas");