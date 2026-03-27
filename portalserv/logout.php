<?php
    session_start();
    unset($_SESSION["usuario"]);
    unset($_SESSION["nome"]);
    unset($_SESSION["tipo"]);
    unset($_SESSION["perfil"]);
    unset($_SESSION["origem"]);
    session_destroy();
    header("Location: index.php");
    exit;
?>