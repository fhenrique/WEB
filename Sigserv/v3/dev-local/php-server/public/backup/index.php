<!DOCTYPE html>
<html lang = "en">
<html>
    <head>
        <meta charset="utf-8" http-equiv='refresh' content='5'>
        <title>
            Acervo Virtual
        </title>    

		<link rel="stylesheet" type="text/css" href="estilo.css" />        

<?php
	$host = "localhost";
	$usuario = "id20293837_fveiga";
	$senha = "Senha@3762";
	$database = "id20293837_gamobi";
	$conexao = mysqli_connect($host, $usuario, $senha, $database);

	/*
	if (mysqli_connect_errno())
		echo "erro de conexao".mysqli_connect_error();
	else
		echo "conexao bem sucedida.";
	*/

	$query = "Select * from editora";
	$resultado = mysqli_query($conexao, $query);
	$qtdlinhas = mysqli_num_rows($resultado);

	echo "<table border=1 id='myTableHead' class='table2' style='width:100%' align='center' >";
    echo "<td style='font size=25' width=100%>Acervo Virtual - Cadastro de Editoras</td>";    
    echo "</table>";
    
    echo "<table border=0 id='myTable' class='table'>";
    echo "<tr class='danger'>";
    echo "<th scope='row'>ID</th>";
    echo "<th>DESCRICAO</th>";
    echo "</tr>";

	while($registro = mysqli_fetch_array($resultado))
    {
        $campo_id = $registro['id'];
        $campo_descricao = $registro['descricao'];    	

		echo "<tr>";
		    	
		echo "<td align= 'left'>"."<form action='inserir.php' method='POST'>"."<input type='radio' id='html' name='fav_language' value='HTML'>"."</td>";

        echo "<td>".$campo_id."</td>";
        echo "<td>".$campo_descricao."</td>";
        echo "</tr>";
   	}

    echo "</table>";   	

	echo "<table border=0 id='myTableButtons' class='table'>";
    
    	echo "<td align= 'left'>"."<form action='inserir.php' method='POST'>"."<input type='submit' class='btnInserir' name='submit' id='inserir' style='height: 20px; width: 100px; text-align:center; '  value='Inserir' >"."</td>";

    	echo "<td align= 'left'>"."<form action='alterar.php' method='POST'>"."<input type='submit' class='btnAlterar' name='submit' id='alterar' style='height: 20px; width: 100px; text-align:center; '  value='Alterar' >"."</td>";    	
    
	echo "</table>";   	

?>

</html>