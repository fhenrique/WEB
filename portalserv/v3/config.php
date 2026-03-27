<?php
	
	//$host = "localhost";
	//$usuario = "id20293837_fveiga";
	//$senha = "Senha@3762";
	//$database = "id20293837_gamobi";
	
	//$conexao = mysqli_connect($host, $usuario, $senha, $database);
define('host', 'localhost');
define('usuario', 'id20293837_fveiga');
define('senha', 'Senha@3762');
define('database', 'id20293837_gamobi');

	$conn = new MySQLi(host, usuario, senha, database);
?>