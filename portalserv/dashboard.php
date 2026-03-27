<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href = 'index.php'; </script>";
    }

?>

<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">        
    <title>Portal Serv - Sistema para Gestão de Serviços</title>
  </head>
  <body>

    <?php 
      $var1 = $_SESSION["empresa"]; 
      $usuario = $_SESSION["usuario"]; 
      $perfil = $_SESSION["perfil"]; 
      $origem = $_SESSION["origem"]; 
    ?>

    <div class="menu-bar">
      <h1 class="logo">Portal<span>Serv</span></h1>
      <ul>
        <li><a href="#">Menu <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>


                  <?php
                    echo "<li>";
                    echo "<a href='cad_clientes.php?empresa=";
                    echo $var1;
                    echo "&perfil=$perfil&origem=$origem'><span class='bi bi-person-vcard'></span>&nbsp;Clientes</a>";
                    echo "</li>";
                  ?>        



                  

                  
                  <li>
                    <a href="#"><span class='bi bi-view-stacked'></span>&nbsp&nbsp;Outros Cadastros <i class="fas fa-caret-right"></i></a>
                    
                    <div class="dropdown-menu-1">
                      <ul>
                        <li><a href="#"><span class='bi bi-check2-circle'></span>&nbsp;Garantias/Cobranças</a></li>
                        <li><a href="#"><span class='bi bi-person-gear'></span>&nbsp&nbsp;Técnicos</a></li>
                        

                            <?php
                                if($perfil=='adm'){
                                    echo "<li>";
                                    echo "<a href='cad_usuarios.php?empresa=";
                                    echo $var1;
                                    echo "&perfil=$perfil&origem=$origem'><span class='bi bi-person'></span>&nbsp;Usuários</a>";
                                    echo "</li>";
                                }
                            ?>

                        <li><a href="#"><span class='bi bi-wrench'></span>&nbsp&nbsp;Serviços</a></li>
                        <li><a href="#"><span class='bi bi-boxes'></span>&nbsp&nbsp;Estoque</a></li>
                        <li><a href="#"><span class='bi bi-building-gear'></span>&nbsp&nbsp;Fornecedores</a></li>
                        <li><a href="#"><span class='bi bi-tools'></span>&nbsp&nbsp;Equipamentos</a></li>
                        <li><a href="#"><span class='bi bi-compass'></span>&nbsp&nbsp;Zonas</a></li>
                        <li><a href="#"><span class='bi bi-car-front'></span>&nbsp&nbsp;Veículos</a></li>
                      </ul>
                    </div>
                  </li>
                  <li><a href="#"><span class='bi bi-calendar-date'></span>&nbsp&nbsp;Agenda</a></li>
                  <li><a href="#"><span class='bi bi-calendar-check'></span>&nbsp&nbsp;Próximas Visitas</a></li>
                  <li><a href="#"><span class='bi bi-currency-dollar'></span>&nbsp&nbsp;Orçamentos</a></li>
                  <li><a href="logout.php"><span class='bi bi-arrow-left-square'></span>&nbsp&nbsp;Logout</a></li>
                </ul>
              </div>
        </li>
        <li><a href="#">Ferramentas <i class="fas fa-caret-down"></i></a>
        <div class="dropdown-menu">
                <ul>
                <li><a href="#"><span class='bi bi-recycle'></span>&nbsp&nbsp;Atualizador</a></li>
              </ul>
        </div>
      </ul>
      <u>
      --------------------------------------------------------------------------------------------------------------
      </u>        
      <p align="right">
        <u>
        <font size="2" face="arial" color="white">
        <span class='bi bi-person'></span> <?php echo $usuario; echo '&nbsp &nbsp &nbsp &nbsp Perfil: '; echo $perfil ?>
        </font>          
        </u>
      </p>              

    </div>
    



    <?php
    if ($_SESSION["empresa"] == "xsol"){
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
