<?php

if(isset($_COOKIE['idUsuario'])){

    header("Location:area_usuario.php");

}
require_once("conn.php");
require_once("funcoes.php");
include_once("send_mail/email.php");

if(isset($_POST['email'])){

    $email = $_POST['email'];



    if(valida_email($email)){

        $requisicao = "SELECT * FROM usuarios WHERE email = ?";

        $stmt = $conn->prepare($requisicao);

        $stmt->bind_param("s",$email);

        $stmt->execute();

        $resultado = $stmt->get_result();

        

        if($resultado->num_rows > 0){

            $resultado = $resultado->fetch_assoc();

            $nova_senha = random_str_generator(8);

            $inserir = "UPDATE usuarios SET senha = ? WHERE id = ?";

            $envio = $conn->prepare($inserir);

            $envio->bind_param('si',MD5($nova_senha),$resultado['id']);

            if($envio->execute() === TRUE){

                $alertas[] = "Senha alterada com sucesso!";



                $assunto = "Alteração de senha.";

                $mensagem = "<p style='font-size: 18px;margin-top:25px;font-family:Arial;font-weight:400;'>Olá, <b style='color:#245177'>".ucwords($resultado['nome'])."!</b> 

				Sua nova senha: <b style='color:#245177'>$nova_senha\n</b> Recomendamos alterar a senha o mais rápido possível.

				

				Clique em: <a href='www.sistemadoestudante.com/sistema/'>Área do estudante</a>				

				

				Atenciosamente,

                Equipe Sistema do Estudante</p>";



                envia_email($email,$assunto,$mensagem);

                setcookie("tipoAlerta","sucesso");

                setcookie("alerta","Senha enviada para: $email");

                header("location:index.php");

            }else{

                $alertas[] = "Erro ao alterar senha";

                header("location:index.php");

            }

        }else{

            setcookie("tipoAlerta","erro");

            setcookie("alerta","E-mail não encontrado");

            header("location:recuperar_senha.php");

        }

    }

}else{

    header("location:index.php");

}