<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acervo Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Acervo Virtual</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          <a class="nav-link" href="?page=novo">Novo Livro</a>
          <a class="nav-link" href="?page=listar">Lista de Livros</a>
          <a class="nav-link" href="?page=pesquisar">Pesquisar Livros</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col mt-5">
        <?php
            include("config.php");
            
            switch(@$_REQUEST["page"]){
              case "novo":
                include("novo-livro.php");
              break;
              case "listar":
                include("listar-livro.php");
              break;
              case "salvar":
                include("salvar-livro.php");
              break;              
              case "editar":
                include("editar-livro.php");
              break;                            
              case "pesquisar":
                include("pesquisar-livro.php");
              break;                                          
              default:
                print "<h1>Bem vindos!<h1>";
                print "<h6>Este é um projeto integrador, como pré-requisito para aprovação no portfólio 2 da disciplina Programação para Web do curso de Licenciatura em Computação da Rede de Educação Claretiano.<h6>";                
            }
          ?>        
      </div>
    </div>
  </div>

  <h6>
    <br><br><br><br><br><br><br><br><br><br>
    Aluno: Fábio Henrique Rodrigues Veiga - 8181827<br>
    Professor: Caio de Jesus Gregoratto
  </h6>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



  </body>
</html>