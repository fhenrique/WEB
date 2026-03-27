<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href = 'index.php'; </script>";
    }

    //include('cad_clientes.php');
?>

<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="style.css" />
    <title>SigServ - Sistema para Gestão de Serviços</title>
  </head>
  <body>
    <div class="menu-bar">
      <h1 class="logo">Sig<span>Serv </span></h1>
      <ul>
        <li><a href="#">Menu <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                  <li><a href="#">Cadastro de Clientes</a></li>
                    <?php
                      include(cad_clientes.php);
                    ?>
                  <li>
                    <a href="#">Outros Cadastros <i class="fas fa-caret-right"></i></a>
                    
                    <div class="dropdown-menu-1">
                      <ul>
                        <li><a href="#">Garantias/Cobranças</a></li>
                        <li><a href="#">Técnicos</a></li>
                        <li><a href="#">Usuários</a></li>
                        <li><a href="#">Serviços</a></li>
                        <li><a href="#">Estoque</a></li>
                        <li><a href="#">Fornecedores</a></li>
                        <li><a href="#">Equipamentos</a></li>
                        <li><a href="#">Zonas</a></li>
                        <li><a href="#">Veículos</a></li>
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
    


    <?php
    if ($_SESSION["usuario"] == "xsol"){
      ?>      
        <div class="xsol">
          &nbsp;
          <h1>Continua xsol</h1>
        </div>
      <?php

    }else{
      ?>      
        <div class="outra">
        &nbsp;
          <h1>Continua outra</h1>          
        </div>
      <?php
    }
  ?>




  </body>
</html>
