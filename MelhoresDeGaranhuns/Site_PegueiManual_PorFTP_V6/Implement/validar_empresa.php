<?php
session_start();
ini_set('upload_max_filesize', '2M');

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

$nome = isset($_POST['nova-empresa']) ? ($_POST['nova-empresa']) : null;
$telefone = isset($_POST['telefone-nova-empresa']) ? $_POST['telefone-nova-empresa'] : null;
$endereco = isset($_POST['endereco-nova-empresa']) ? ($_POST['endereco-nova-empresa']) : null;
$segmento = isset($_POST['segmento-nova-empresa']) ? $_POST['segmento-nova-empresa'] : null;
$descricao = isset($_POST['descricao-nova-empresa']) ? ($_POST['descricao-nova-empresa']) : null;
$link = isset($_POST['link-nova-empresa']) ? ($_POST['link-nova-empresa']) : null;

//  ÁREA DE REFINAMENTO DA LOGO
$file = $_FILES['logo'];
$extensao = explode(".",$file['name']);
$extensao = $extensao[count($extensao)-1];
$nome_logo = MD5(Date('Y-m-d H:i:s'));
$novo_nome_logo = $nome_logo.".".$extensao;
$caminho_logo = 'uploads/'.$novo_nome_logo;

$dados = array(
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
    $e->setNome($nome);
    $e->setTelefone($telefone);
    $e->setEndereco($endereco);
    $e->setSegmento($segmento);
    $e->setDescricao($descricao);
    $e->setImagem($caminho_logo);
    $e->setLink($link);

    try{
        $e->insert();
        $a->add(array("tipo" => "success", "msg" => "Empresa inserida."));
        
        //  INSERINDO A IMAGEM NO BANCO DE DADOS
        $f = new Funcoes();
        $c = $f->geraConexao();
        if(move_uploaded_file($file['tmp_name'],$caminho_logo)){
            $addLogo = $c->prepare("INSERT INTO imagens (titulo,caminho,data_upload) VALUES (?,?,?)");
            $addLogo->bind_param("sss",$file['name'],$caminho_logo,$f->hoje());
            
            if($addLogo->execute() === TRUE){

            }else{
                $a->add(array("tipo" => "danger", "msg" => "Erro ao adicionar Logotipo."));
            }

        }

    }catch (Exception $e){
        $a->add(array("tipo" => "danger", "msg" => $e->getMessage()));

    }

}

$_SESSION['alertas'] = serialize($a);
header("Location:/adicao");