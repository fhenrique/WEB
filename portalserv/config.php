<?php
	
	$host = "localhost";
	$usuario = "root";
	$senha = "senha3762";
	$database = "db_portalsolar";
	
	//$conexao = mysqli_connect($host, $usuario, $senha, $database);
/*
	define('host', 'mysql.xsolaquecedores.com.br');
define('usuario', 'xsolaquecedore01');
define('senha', 'xsol303080');
define('database', 'xsolaquecedore01');
*/

	//$conn = new MySQLi(host, usuario, senha, database);
	$conn = mysqli_connect($host,$usuario,$senha,$database,'3306');
	