<?php
session_start();

require_once("classes/usuario.php");
require_once("classes/empresa.php");
require_once("classes/alertas.php");
require_once("classes/segmentos.php");
require_once("classes/funcoes.php");
require_once("classes/avaliacao.php");

$prosseguir = TRUE;

if(!isset($_SESSION['userID']))
$prosseguir = FALSE;

$r = array();

if($prosseguir)
{
    //  Usuario
    $u = new Usuario();
    $u->setIdExterno($_SESSION['userID']);
    $u->select();

    //  Alertas
    $a = new Alertas();

    $idEmpresa = isset($_POST['empresaRate']) && !empty($_POST['empresaRate']) ? $_POST['empresaRate'] : null;
    if(isset($_POST['estrelas']) && !empty($_POST['estrelas']))
    {
        $estrelas = str_replace("s","",$_POST['estrelas']);
        $estrelas = explode("-", $estrelas)[0];
    }else
    {
        $estrelas = null;
    }

    if($idEmpresa == null)
    {
        $a->add(array("tipo" => "danger", "msg" => "Empresa Inválida"));
        $prosseguir = FALSE;
    }

    if($estrelas == null || $estrelas < 1 || $estrelas > 5)
    {
        $a->add(array("tipo" => "danger", "msg" => "Insira uma nota válida."));
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
            $a->add(array("tipo" => "success", "msg" => "Você alterou sua avaliação de <b>".ucwords($rate->empresa->getNome())."</b> para <b>".$estrelas."</b> estrelas."));
            $r['status'] = "success";
            
        }catch (Exception $e)
        {
            try
            {
                $rate->setPontos($estrelas);
                $rate->insert();
                $a->add(array("tipo" => "success", "msg" => "Você avaliou <b>".ucwords($rate->empresa->getNome())."</b> com <b>".$estrelas."</b> estrelas."));
                $r['status'] = "success";
                
            } catch (Exception $erro)
            {
                $a->add(array("tipo" => "danger", "msg" => $erro->getMessage()));
                $r['status'] = "error";
            }
            
        }
        
        
    }else
    {
        $r['status'] = "error";
    }

    $r['data'] = $a;
}else
{
    $r['status'] = "error";
}

echo json_encode($r, JSON_PRETTY_PRINT);