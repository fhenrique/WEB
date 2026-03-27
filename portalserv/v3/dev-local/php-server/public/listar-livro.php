<h1>Listar livros</h1>
<?php
	//$sql = "SELECT a.id, a.titulo, b.descricao FROM acervo a LEFT INNER editora b ON a.id_editora = b.id;";
	$sql = "SELECT * FROM acervo";
	$res = $conn->query($sql);
	$qtd = $res->fetchColumn();

	if($qtd > 0){
		print "<table class='table table-hover'>";
		print "<tr>";
		print "<th>TITULO</th>";
		print "<th>EDITORA</th>";
		print "</tr>";		
		while($row = $res->fetch_object()){
			print "<tr>";
			print "<td>".$row->titulo."</td>";
			print "<td>".$row->descricao."</td>";
			print "<td>

					<button onclick=\"location.href='?page=editar&id=".$row->id."';\" class='btn btn-success'>Editar</button>
					
					<button onclick=\" if(confirm('Confirma a exclusão?')){location.href='?page=salvar&acao=excluir&id=".$row->id."';}
					else{false;} \" class='btn btn-danger'>Excluir</button>

					</td>";
			print "</tr>";

		}
		print "</table>";
	}
	else{
		print "<p class='alert alert-danger'> Não há livro(s) cadastrado(s)!</p>";
	}
?>