<?php
    session_start();

    if(empty($_POST) or (empty($_POST["usuario"]) or empty($_POST["senha"]))){
        print "<script>location.href = 'index.php'; </script>";
    }

    include('config.php');

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $empresa = $_POST["empresa"];

    $sql = "SELECT * FROM usuarios WHERE usuario = '{$usuario}' AND senha = '{$senha}' AND empresa = '{$empresa}'";
    
    $res = $conn->query($sql) or die($conn->error); //executando o select e salvando o retorno na variavel res

    $row = $res->fetch_object(); //gerando o aray de objetos dentro da variavel row

    $qtd = $res->num_rows; //obtendo a qtd de registros e guardando na variavel qtd

    if($qtd > 0){
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nome'] = $row->nome;
        $_SESSION['tipo'] = $row->tipo;
        print "<script>location.href = 'dashboard.php'; </script>";
    }else{
        print "<script>alert('Usuário e/ou senha incorreto(s).'); </script>";
        print "<script>location.href = 'index.php'; </script>";
    }
?>

