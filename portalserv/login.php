<?php
    session_start();

    if(empty($_POST) or (empty($_POST["usuario"]) or empty($_POST["senha"]))){
        print "<script>location.href = 'index.php'; </script>";
    }

    include('config.php'); #executo o config.php

    $usuario = $_POST["usuario"]; #pego a variavel usuario que vem do POST do index.php
    $senha = $_POST["senha"]; #pego a variavel senha que vem do POST do index.php
    $empresa = $_POST["empresa"]; #pego a variavel empresa que vem do POST do index.php

    $sql = "SELECT * FROM usuarios WHERE usuario = '{$usuario}' AND senha = '{$senha}' AND empresa = '{$empresa}'";

    $res = $conn->query($sql) or die($conn->error); //executando o select e salvando o retorno na variavel res
    $row = $res->fetch_object(); //gerando o aray de objetos dentro da variavel row

    $qtd = $res->num_rows; //obtendo a qtd de registros e guardando na variavel qtd

    if($qtd > 0){
        $perfil = $row->perfil;
        $origem = $row->perfil;
        #echo $perfil; exit;

        $_SESSION['empresa'] = $empresa;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nome'] = $row->nome;
        $_SESSION['tipo'] = $row->tipo;
        $_SESSION['perfil'] = $row->perfil;
        $_SESSION['origem'] = $row->perfil;
    
        print "<script>location.href = 'dashboard.php?perfil=$perfil&origem=$origem'; </script>";
    }else{
        print "<script>alert('Usuário e/ou senha incorreto(s).'); </script>";
        print "<script>location.href = 'index.php'; </script>";
    }


