<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href = 'index.php'; </script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Gestor de Serviços </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
      body, html {
        height: 100%;
        margin: 0;
      }

      .bg_xsol {
        /* The image used */
        background-image: url("http://melhoresdegaranhuns.com.br/xsolCloud/imgPrincipal10.jpg");

        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }

      .bg_outra {
        /* The image used */
        background-image: url("chupacabra.jpg");

        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }      
    </style>

  </head>
  <body>

  <form action="" method="" >

      <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
              <a class="navbar-brand">Sistema Gestor de Serviços</a>
              <?php
                  print "Olá ".$_SESSION["nome"];
                  print "<a href='logout.php' class='btn btn-danger'>Sair</a>";
              ?>
          </div>
      </nav>

      <?php
        if($_SESSION["usuario"] == "xsol"){
          ?>

              <nav class="navbar navbar-expand-lg bg-danger">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                      <a class="nav-link" href="?page=novo">Novo Livro</a>
                      <a class="nav-link" href="?page=listar">Lista de Livros</a>
                      <a class="nav-link" href="?page=novaeditora">Nova Editora</a>
                      <a class="nav-link" href="?page=listareditoras">Lista de Editoras</a>
                      <a class="nav-link" href="?page=pesquisar">Pesquisar Livros</a>
                    </div>
                  </div>
                </div>
              </nav>
          <?php

        } 
        else{
?>
              <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                      <a class="nav-link" href="?page=novo">Novo Livro</a>
                      <a class="nav-link" href="?page=listar">Lista de Livros</a>
                      <a class="nav-link" href="?page=novaeditora">Nova Editora</a>
                      <a class="nav-link" href="?page=listareditoras">Lista de Editoras</a>
                      <a class="nav-link" href="?page=pesquisar">Pesquisar Livros</a>
                    </div>
                  </div>
                </div>
              </nav>
<?php

        }     
      ?>


      <div class="form-control">
        <select id="empresa" name="empresa" onchange="location = this.value;">
          <option value="dashboard.php">Menu</option>
          <option value="0">Cadastro de clientes</option>
          <option value="0">+ Cadastros</option>
          <option value="0">Agenda</option>
          <option value="0">Próximas Visitas</option>
          <option value="0">Orçamentos</option>
          <option value="0">Configurações</option>
          <option value="logout.php">Sair</option>
        </select>
      </div>


      
  </form>
  

  <?php
    if ($_SESSION["usuario"] == "xsol"){
      ?>      
        <div class="bg_xsol"></div>
        <?php

    }else{
      ?>      
        <div class="bg_outra"></div>
      <?php
    }
  ?>


  


  </body>
</html>