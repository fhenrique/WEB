<?php
	//Se o parametro de busca não for encontrado, mando o location para o index
	if(!isset($_GET['nome_livro'])){
		header("Location: index.php");
		exit;
	}

	$nome = "%".trim($_GET['nome_livro'])."%";
	$dbh = new PDO('mysql:host=localhost;dbname=id20293837_gamobi','id20293837_fveiga','Senha@3762');
	$sth = $dbh->prepare('SELECT * FROM `acervo` WHERE `titulo` LIKE :nome ORDER BY titulo');
	$sth->bindParam(':nome', $nome, PDO::PARAM_STR);
	$sth->execute();

	$resultados = $sth->fetchAll(PDO::FETCH_ASSOC);

	echo "<pre>";
	print_r($resultados);
	exit;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Resultado da Busca</title>
</head>
<body>
	<h2>Resultado da busca</h2>
	<?php
		if(count($resultados)>0){
			print "<table class='table table-hover'>";
			print "<tr>";
			print "<th>TITULO</th>";
			print "<th>EDITORA</th>";
			print "</tr>";		
			while($row = $res->fetch_object()){
				print "<tr>";
				print "<td>".$Resultado['titulo']."</td>";
				//print "<td>".$row->descricao."</td>";
				print "<td>

						<button onclick=\"location.href='?page=editar&id=".$row->id."';\" class='btn btn-success'>Editar</button>
						
						<button onclick=\" if(confirm('Confirma a exclusão?')){location.href='?page=salvar&acao=excluir&id=".$row->id."';}
						else{false;} \" class='btn btn-danger'>Excluir</button>

						</td>";
				print "</tr>";
			}
			print "</table>";
		}else{
			print "<p class='alert alert-danger'> Não há livro(s) cadastrado(s)!</p>";
		}
	?>
</body>
</html>