<h1>Listar Editoras</h1>
<?php
	$sql = "SELECT id, descricao FROM editora ORDER BY descricao;";
	$res = $conn->query($sql);
	$qtd = $res->num_rows;

	if($qtd > 0){
		print "<table class='table table-hover'>";
		print "<tr>";
		print "<th>EDITORA</th>";
		print "</tr>";		
		while($row = $res->fetch_object()){
			print "<tr>";
			print "<td>".$row->descricao."</td>";
			print "<td>

					<button onclick=\"location.href='?page=editareditora&id=".$row->id."';\" class='btn btn-success'>Editar</button>
					
					<button onclick=\" if(confirm('Confirma a exclusão?')){location.href='?page=salvar&acao=excluireditora&id=".$row->id."';}
					else{false;} \" class='btn btn-danger'>Excluir</button>

					</td>";
			print "</tr>";

		}
		print "</table>";
	}
	else{
		print "<p class='alert alert-danger'> Não há editora cadastrada</p>";
	}
?>