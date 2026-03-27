<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>Acervo Virtual</title>
    	<link rel="stylesheet" type="text/css" href="estilo.css" />
	</head>
<div id="tudo">
    <div id="topo">
        <h1>
            Acervo Virtual
        </h1>
    </div>
    <div id="navegacao" class="navegacao">
        <h3>&nbsp;</h3>
        <ul>
            <li id="it1" class="itens">Acervo</li>
            <li id="it2" class="itens">Editoras</li>
			<br>
			<br>
        </ul>
    </div>

    <div id="principal">

    	Claretiano Rede de Educação <br>Curso: Licenciatura (computação)<br>Semestre: 2023.2<br>Disciplina: Programação para Web<br>Portifólio: 02<br>Atividade: Projeto Integrador

    </div>

    <div id="rodape" class="rodape">
    	<br>
        Aluno: Fábio Henrique Rodrigues Veiga - RA 8181827
    </div>
</div>

<body>
  <script> 
    document.getElementById("it1").addEventListener("click", acervo)
    function acervo()
    {
      window.location.href='acervo.php';
    }                                       

    document.getElementById("it2").addEventListener("click", editoras)
    function editoras()
    {
      window.location.href='editoras.php';
    }                                                
  </script>
</body>

</html>