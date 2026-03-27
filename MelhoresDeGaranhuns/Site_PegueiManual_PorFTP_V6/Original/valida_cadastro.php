<?php
if(session_id() == "")
    session_start();

include_once("classes/usuario.php");
include_once("classes/funcoes.php");
include_once("classes/alertas.php");

$funcs = new Funcoes();
$alertas = new Alertas();

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;
$confSenha = isset($_POST['conf-senha']) ? $_POST['conf-senha'] : null;

$prosseguir = TRUE;

if($nome != null && $nome != ""){
    $nome = mb_strtolower(trim($nome));

}else{
    $prosseguir = FALSE;
    $alertas->add(array("tipo" => "danger", "msg" => "Insira um nome válido."));

}

if($telefone != null && $telefone != ""){
    $telefone = mb_strtolower(trim($telefone));

}else{
    $prosseguir = FALSE;
    $alertas->add(array("tipo" => "danger", "msg" => "Insira um nome válido."));

}

if($email != null && $email != ""){

    if($funcs->valida_email($email)){
        $email = mb_strtolower(trim($email));

    }else{
        $prosseguir = FALSE;
        $alertas->add(array("tipo" => "danger", "msg" => "Email inserido em formato incorreto."));

    }

}else{
    $prosseguir = FALSE;
    $alertas->add(array("tipo" => "danger", "msg" => "Insira um email válido."));

}

if($senha != null && $senha != ""){

    if(strlen($senha) >= 8){
        $senha = MD5($senha);

    }else{
        $prosseguir = FALSE;

    }

}else{
    $prosseguir = FALSE;

}

if($confSenha != null && $confSenha != ""){

    if(strlen($confSenha) >= 8){
        $confSenha = MD5($confSenha);

    }else{
        $prosseguir = FALSE;

    }

}else{
    $prosseguir = FALSE;

}

if($senha != $confSenha){
    $prosseguir = FALSE;
    $alertas->add(array("tipo" => "danger", "msg" => "Senhas não coincidem."));
}

if($prosseguir){
    $usuario = new Usuario();
    $usuario->setNomeCompleto($nome);
    $usuario->setTelefone($telefone);
    $usuario->setEmail($email);

    try{
        $usuario->insert($senha,$confSenha);
        header("Location:/login");
    } catch (Exception $e){
        $alertas->add(array("tipo" => "danger", "msg" => $e->getMessage()));
        $_SESSION['alertas'] = serialize($alertas);
        header("Location:/cadastro");
    }

}else{
    $_SESSION['alertas'] = serialize($alertas);
    header("Location:/cadastro");
}
?>