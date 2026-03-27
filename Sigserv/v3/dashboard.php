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
    <title>SigServ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="style.css" />    
  </head>
  <body>
    
  <div class="menu-bar">
      <h1 class="logo">Sig<span>Serv </span></h1>
      <ul>
        <li><a href="#">Menu <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
				  <li><a href="?page=cad_clientes">Cadastro de Clientes</a></li>
                  <li>
                    <a href="#">Outros Cadastros <i class="fas fa-caret-right"></i></a>
                    
                    <div class="dropdown-menu-1">
                      <ul>
                        <li><a href="?page=#">Garantias/Cobranças</a></li>
                        <li><a href="?page=#">Técnicos</a></li>
                        <li><a href="?page=#">Usuários</a></li>
                        <li><a href="?page=#">Serviços</a></li>
                        <li><a href="?page=#">Estoque</a></li>
                        <li><a href="?page=#">Fornecedores</a></li>
                        <li><a href="?page=#">Equipamentos</a></li>
                        <li><a href="?page=#">Zonas</a></li>
                        <li><a href="?page=#">Veículos</a></li>
                      </ul>
                    </div>
                  </li>
                  <li><a href="#">Agenda</a></li>
                  <li><a href="#">Próximas Visitas</a></li>
                  <li><a href="#">Orçamentos</a></li>
                  <li><a href="logout.php">Sair</a></li>
                </ul>
              </div>
        </li>
        <li><a href="#">Ferramentas <i class="fas fa-caret-down"></i></a>
        <div class="dropdown-menu">
                <ul>
                <li><a href="#">Atualizador</a></li>
              </ul>
        </div>

      </ul>
    </div>


  

    <div class="container">
      <div class="row">
        <div class="col mt-5">
          <?php
              include("config.php");
              
              switch(@$_REQUEST["page"]){
                case "cad_clientes":
                  include("cad_cliente_view.php");
                break;
                case "listar":
                  include("listar-livro.php");
                break;              
                case "novaeditora":
                  include("nova-editora.php");
                break;              
                case "listareditoras":
                  include("listar-editoras.php");
                break;              
                case "salvar":
                  include("salvar.php");
                break;              
                case "editar":
                  include("editar-livro.php");
                break;                            
                case "editareditora":
                  include("editar-editora.php");
                break;                                          
                case "sair":
                  include("logout.php");
                break;                                          
                default:
                  //print "<h1>Bem vindos!<h1>";
                  
              }
            ?>        
        </div>
      </div>
    </div>


    <?php
      if ($_SESSION["usuario"] == "xsol"){
        ?>      
          <div class="xsol">
            &nbsp;
            <h3>Padrão xsol</h3>
          </div>
        <?php

      }else{
        ?>      
          <div class="outra">
          &nbsp;
            <h3>Outro padrão</h3>          
          </div>
        <?php
      }
    ?> 



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>