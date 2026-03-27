<?php
if(session_id() == "")
    session_start();

if(isset($_SESSION['userID'])){
    include_once("classes/usuario.php");
    include_once("classes/funcoes.php");
    include_once("classes/alertas.php");

    $funcs = new Funcoes();
    $alertas = new Alertas();

    $nome = isset($_POST['nome-edit']) ? $_POST['nome-edit'] : null;
    $telefone = isset($_POST['telefone-edit']) ? $_POST['telefone-edit'] : null;

    $prosseguir = TRUE;

    if($nome != null && $nome != ""){
        $nome = mb_strtolower(trim($nome));

    }else{
        $prosseguir = FALSE;
        $alertas->add(array("tipo" => "danger", "msg" => "Insira um nome válido."));

    }

    if($prosseguir){
        $usuario = new Usuario();
        $usuario->setIdExterno($_SESSION['userID']);
        $usuario->setNomeCompleto($nome);
        $usuario->setTelefone($telefone);
        
        try{
            $usuario->update();
            $alertas->add(array("tipo" => "success", "msg" => "Dados alterados com sucesso."));
            $_SESSION['alertas'] = serialize($alertas);
            header("Location:/perfil");
        } catch (Exception $e){
            $alertas->add(array("tipo" => "danger", "msg" => $e->getMessage()));
            
        }
    }else{
        $_SESSION['alertas'] = serialize($alertas);
        header("Location:/");
    }
}else{
    header("Location:/");
}