<!DOCTYPE html>
<html lang = "en">
<html>
	<head>
		<meta charset="utf-8" http-equiv='refresh' content='5'>
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
                text-align: center;
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

		<!--
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
					integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
					crossorigin="anonymous">
		</script>
		
		
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous">
		</script>
		
        <script src="https://code.jquery.com/jquery-3.5.1.js"
                integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" 
                crossorigin="anonymous">
		</script>		
		-->
	</head>
	
	
	<body>

	</body>
	
<?php

	echo "<table border=1 id='myTableHead' class='table2'>";
	echo "<td style='font size=25'>TudoEu - PEDIDOS DE PRESTADORES DE SERVIÇO</td>";	
	echo "</table>";
	
	echo "<table border=0 id='myTable' class='table'>";
	echo "<tr class='danger'>";
	echo "<th scope='row'>ID</th>";
	echo "<th>TIPO</th>";
	echo "<th>DATA</th>";
	echo "<th>HORA</th>";
	echo "<th>ENDEREÇO</th>";
	echo "<th>OBSERVAÇÕES DO SERVIÇO</th>";
	echo "<th>CLIENTE</th>";
	echo "<th>TELEFONE</th>";
	echo "<th>OBSERVAÇÕES DO CLIENTE</th>";
	echo "<th>ATENDE</th>";
	echo "</tr>";
	
	$host = "108.167.132.240";
	$usuario = "melho972_fabio";
	$senha = "senha@3762";
	$basededados = "melho972_tudoeu";	
	
	$strcon = mysqli_connect($host,$usuario,$senha,$basededados);
	$sql = "SELECT id, srv_tipo, srv_data, srv_hora, srv_endereco, srv_obs, cli_nome, cli_telefone, cli_obs FROM dados Where status = '1'";
	$resultado = mysqli_query($strcon,$sql);
	$rowcount = mysqli_num_rows($resultado);
	
	//echo "Qtd. de serviços pendentes: ".$rowcount;
	
	if($rowcount > 0)
	{
		echo "<embed src='alert.mp3'width='1' height='1'>";
	}	
	
	while($registro = mysqli_fetch_array($resultado))
	{
		$serv_id = $registro['id'];
		$serv_tipo = $registro['srv_tipo'];
		
		$serv_data = $registro['srv_data'];
		$serv_data_dt = new DateTime();
		$serv_data_show = $serv_data_dt->format('d-m-Y');
		
		
		$serv_hora = $registro['srv_hora'];
		$serv_endereco = $registro['srv_endereco'];
		$serv_obs = $registro['srv_obs'];
		$cl_nome = $registro['cli_nome'];
		$cl_telefone = $registro['cli_telefone'];
		$cl_obs = $registro['cli_obs'];
		
		
		echo "<tr>";
		echo "<td>".$serv_id."</td>";
		echo "<td>".$serv_tipo."</td>";
		echo "<td>".$serv_data_show."</td>";
		echo "<td>".$serv_hora."</td>";
		echo "<td>".$serv_endereco."</td>";
		echo "<td>".$serv_obs."</td>";
		echo "<td>".$cl_nome."</td>";
		echo "<td>".$cl_telefone."</td>";
		echo "<td>".$cl_obs."</td>";
		echo "<td align= 'center'>"."<form action='atende.php' method='POST'>"."<input type='submit' class='btnSelect' name='submit' id='atender' style='height: 20px; width: 40px; text-align:center; '  value='' >"."</td>";
		echo "</tr>";
	}

	mysqli_close;
	
	echo "</table>";
	
	/////
	$sql = "SELECT id FROM dados Where notificado = 'N'";
	$resultado = mysqli_query($strcon,$sql);
	$rowcount = mysqli_num_rows($resultado);
	
	if($rowcount > 0)
	{
		function send_whatsapp($message="Test"){
			$phone="5511987539544";  
			$apikey="3557255";       //APIKEY da callmebot
			//$apikey="GzNXrVz35DXY";  //apikey da textMeBot
			
			
			$url='https://api.callmebot.com/whatsapp.php?source=php&phone='.$phone.'&text='.urlencode($message).'&apikey='.$apikey; //URL CallMeBot
			//$url='http://api.textmebot.com/send.php?recipient=+5511987539544&apikey=GzNXrVz35DXY&text=This%20is%20a%20test'; //URL TextMeBot


			if($ch = curl_init($url))
			{
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$html = curl_exec($ch);
				$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				return (int) $status;
			}
			else
			{
				return false;
			}
		}

		send_whatsapp("Chegou uma nova solicitação no Tudo Eu Gerenciador!");			

		mysqli_query($strcon,"UPDATE dados set notificado = 'S' where id = ". $serv_id);
	}
	
?>	

</html>	