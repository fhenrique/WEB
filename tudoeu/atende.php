<?php
	if(isset($_POST['submit']))
	{
		$host = "108.167.132.240";
		$usuario = "melho972_fabio";
		$senha = "senha@3762";
		$basededados = "melho972_tudoeu";
		
		$srv_id = $_POST['txtid'];
		
		$conexao = new mysqli($host,$usuario,$senha,$basededados);
		
		
		if($result = mysqli_query($conexao,"UPDATE dados set status = 0 where id = ". $srv_id))
		{
			echo " ";
			echo "<script type='text/javascript'>";
			echo "window.open('https://www.melhoresdegaranhuns.com.br/tudoeu/consulta.php', '_self')";
			echo "</script>";
		
		}
		else
		{
			echo " ";
			
			header( 'Location: https://www.melhoresdegaranhuns.com.br/tudoeu/consulta.php' );
		}
		
		
	}
?>

<!DOCTYPE html>
<html lang = "en">
<html>
	<head>
		<title>
			Tudo Eu, atendimento!
		</title>

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
                text-align: center;
            }
  
            td {
                font-weight: lighter;
            }
			
        </style>
		
	</head>

<?php
	echo "<table border=0 id='myTable' class='table'>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>TIPO</th>";
	echo "<th>DATA</th>";
	echo "<th>HORA</th>";
	echo "<th>CLIENTE</th>";
	echo "<th>TELEFONE</th>";
	echo "</tr>";
	
	$host = "108.167.132.240";
	$usuario = "melho972_fabio";
	$senha = "senha@3762";
	$basededados = "melho972_tudoeu";	
	
	$strcon = mysqli_connect($host,$usuario,$senha,$basededados);
	$sql = "SELECT id, srv_tipo, srv_data, srv_hora, srv_endereco, srv_obs, cli_nome, cli_telefone, cli_obs FROM dados Where status = '1'";
	$resultado = mysqli_query($strcon,$sql);
	//$rowcount = mysqli_num_rows($resultado);
	
	//if($rowcount > 0)
	//{
	//	echo "<embed src='alert.mp3'width='1' height='1'>";
	//}	
	
	while($registro = mysqli_fetch_array($resultado))
	{
		$serv_id = $registro['id'];
		$serv_tipo = $registro['srv_tipo'];
		$serv_data = $registro['srv_data'];
		$serv_hora = $registro['srv_hora'];
		$cl_nome = $registro['cli_nome'];
		$cl_telefone = $registro['cli_telefone'];
		
		echo "<tr>";
		echo "<td>".$serv_id."</td>";
		echo "<td>".$serv_tipo."</td>";
		echo "<td>".$serv_data."</td>";
		echo "<td>".$serv_hora."</td>";
		echo "<td>".$cl_nome."</td>";
		echo "<td>".$cl_telefone."</td>";
		echo "</tr>";
	}

	mysqli_close;
	
	echo "</table>";

?>	
	
		<body>
			<div class="box">
				<table style = "border-collapse:collapse;" >
					<thead>
					<tr align= "center">
						<td style="font size='25'">
							<strong style="font-size: 25px; color:#e84026; font-family:verdana;">Atendimento!</strong>
						</td>
					</tr>
				</table>
				
				
				<table style = "height:100%; width:100%; border=0; border-collapse:collapse; background-color:#dee5fc;" >
					<tr>
						<td>
							<form action="atende.php" method="POST">
								<div style="padding-left:5px; text-align: left;">
									<table style = "width:100%; border=0; border-collapse:collapse; background-color:#dee5fc;" >
										<tr align= "center">
											<td style="font size:15;">
													<br>
													<strong style="font-size: 15px; font-family:verdana;">ID</strong>
													<input type="number" name="txtid" id="txtid" type="Text" class="form-control" placeholder="Informe o ID do serviço">
													</div>
											</td>
										</tr>
											<td style="font size:30px; text-align:center;">
													<br>
													<input type="submit" name="submit"id="submit" style="height: 40px; width: 80px;" value="Atendido!" >
											</td>																				
									</table>
								</div>									
							</form>
						</td>												
					</tr>
				</table>
			</div>
		</body>
		
			
		
</html>