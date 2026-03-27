<?php
	switch($_REQUEST["acao"]){
		case "cadastrar":
		$descricao = $_POST["descricao"];
		$sql = "INSERT INTO editoras(descricao) VALUES('{$descricao}')";
		$res = $conexao->query($sql);		


		break;
		case "editar":
		// code...
		break;
		case "excluir":
		// code...
		break;				
	}
?>