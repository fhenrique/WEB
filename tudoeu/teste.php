<!DOCTYPE html>
<html lang = "en">
<html>
	<head>
		<meta charset="utf-8" http-equiv='refresh' content='59'>
		<title>
			Tudo Eu!
		</title>	
		
	<script type="text/javascript">
		$(document).ready(function(){

			$("#myTable").on('click','.btnSelect',function(){
				 var currentRow=$(this).closest("tr"); 
				 
				 var col1=currentRow.find("td:eq(0)").html();
				 var varjs=col1
				 
				 alert(varjs);
			});
		});
	</script>
	
		<style>
            table {
                margin: 0 auto;
                font-size: large;
                border: 0px solid black;
				height: 100%;
            }
  
            h1 {
                text-align: center;
                color: #164585;
                font-size: xx-large;
                font-family: "Gill Sans",
                  "Gill Sans MT", 
                  " Calibri", 
                  "Trebuchet MS",
                  "sans-serif";
            }
  
            th {
                background-color: #b6c0f3;
                border: 0px solid black;
            }
  
            td {
                font-weight: bold;
                border: 0px solid black;
                padding: 10px;
                text-align: left;
            }
  
            td {
                font-weight: lighter;
            }
        </style>
		
        <!-- BOOTSTRAP CSS AND PLUGINS-->
        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
              integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
              crossorigin="anonymous" 
		/>


	</head>
	
	
	<body>

	</body>
	
<?php

	$host = "108.167.132.240";
	$usuario = "melho972_fabio";
	$senha = "senha@3762";
	$basededados = "melho972_tudoeu";	
	$strcon = mysqli_connect($host,$usuario,$senha,$basededados);	
	
	echo "<table border=1 id='myTableHead' class='table2'>";
	echo "<td style='font size=25'>TudoEu - LISTA DE PRESTADORES DE SERVIÇOS</td>";	
	echo "</table>";
	
	echo "<table border=0 id='myTable' class='table'>";
	echo "<tr class='danger'>";
	echo "<th scope='row'>NOME</th>";
	echo "<th>TELEFONE</th>";
	echo "<th>SERVIÇO</th>";
	echo "</tr>";
	
	$sql2 = "SELECT count(*) as quantidade from prestadores";
	$resultado2 = mysqli_query($strcon,$sql2);	
	while($registro2 = mysqli_fetch_array($resultado2))
	{
		$q_qtd 	= $registro2['quantidade'];
		
		echo "Qtd: ".$q_qtd;
	}			
	

	
	$sql = "SELECT nome, telefone, servico FROM prestadores order by servico";
	$resultado = mysqli_query($strcon,$sql);
	
	while($registro = mysqli_fetch_array($resultado))
	{
		$q_nome 	= $registro['nome'];
		$q_telefone = $registro['telefone'];
		$q_servico 	= $registro['servico'];
		
		echo "<tr>";
		echo "<td>".$q_nome."</td>";
		echo "<td>".$q_telefone."</td>";
		echo "<td>".$q_servico."</td>";
		echo "</tr>";
	}

	mysqli_close;
	
	echo "</table>";
	


?>	

</html>	