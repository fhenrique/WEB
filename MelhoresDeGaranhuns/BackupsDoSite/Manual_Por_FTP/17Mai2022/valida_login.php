<?php
if(session_id() == "")
    session_start();

include_once("classes/usuario.php");
include_once("classes/alertas.php");

$alertas = new Alertas();

$email = isset($_POST['email']) ? $_POST['email'] : null;
$pass = isset($_POST['pass']) ? $_POST['pass'] : null;

if($email != null && $pass != null){
    $usuario = new Usuario();
    $usuario->setEmail($email);
    
    if($usuario->login($pass)){
        $_SESSION['userID'] = $usuario->getIdExterno();
        header("Location:/");

    }

}
$alertas->add(array("tipo" => "danger", "msg" => "Email e/ou Senha incorretos."));
$_SESSION['alertas'] = serialize($alertas);
header("Location:/login");
?>