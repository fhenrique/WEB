<?php
if(session_id() == "")
    session_start();

if(isset($_SESSION['userID'])){
    include_once("classes/usuario.php");
    include_once("classes/funcoes.php");
    include_once("classes/alertas.php");

    $funcs = new Funcoes();
    $alertas = new Alertas();

    $senhaAtual = isset($_POST['atual-pass']) ? $_POST['atual-pass'] : null;
    $novaSenha = isset($_POST['novo-pass']) ? $_POST['novo-pass'] : null;
    $confNovaSenha = isset($_POST['conf-novo-pass']) ? $_POST['conf-novo-pass'] : null;

    $usuario = new Usuario();
    $usuario->setIdExterno($_SESSION['userID']);
    $usuario->select();

    if($usuario->login($senhaAtual)){

        if($novaSenha == $confNovaSenha){

            try{
                $usuario->updateSenha($novaSenha,$confNovaSenha);
                $alertas->add(array("tipo" => "success", "msg" => "Senha alterada com sucesso."));
                $_SESSION['alertas'] = serialize($alertas);
                header("Location:/perfil");

            }catch (Exception $e){
                $alertas->add(array("tipo" => "danger", "msg" => $e));

            }

        }else{
            $alertas->add(array("tipo" => "danger", "msg" => "Novas senhas não coincidem."));

        }

    }else{
        $alertas->add(array("tipo" => "danger", "msg" => "Senha atual Incorreta"));

    }

    $_SESSION['alertas'] = serialize($alertas);
    header("Location:/perfil");
}else{
    header("Location:/");
}