<?php

require_once('email/PHPMailer.php');
require_once('email/SMTP.php');
require_once('email/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function envia_email($destino,$assunto,$mensagem){

	$mail = new PHPMailer(true);

	$msgHTML = $mensagem;

	try {
		$mail->CharSet = "UTF-8";
		$mail->isSMTP();
		$mail->Host = 'smtp.titan.email';
		$mail->SMTPAuth = true;
		$mail->Username = 'contato@melhoresdegaranhuns.com.br';
		$mail->Password = 'mdg@2022';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;

		$mail->setFrom('contato@melhoresdegaranhuns.com.br');
		$mail->addAddress($destino);

		$mail->isHTML(true);
		$mail->Subject = $assunto;
		$mail->Body = nl2br($msgHTML);
		$mail->AltBody = $mensagem;

		if($mail->send()) {
			return TRUE;
		} else {
			return FALSE;
		}

	} catch (Exception $e) {
		return FALSE;
	}

}