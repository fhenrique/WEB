<?php
if(session_id() == "")
  session_start();

include_once("classes/usuario.php");
include_once("classes/alertas.php");
include_once("classes/listaEmpresas.php");
include_once("classes/carrossel.php");
require_once("classes/segmentos.php");

if(isset($_SESSION['userID']) && $_SESSION['userID'] != ""){
  $usuario = new Usuario();
  $usuario->setIdExterno($_SESSION['userID']);
  $usuario->select();
}


$funcs = new Funcoes();

$listaEmpresas = new ListaEmpresas();

if(isset($_GET["s"])){
    $listaEmpresas->setListaBySegmento($_GET["s"]);
}
$listaEmpresas->ordenar();
$empresas = $listaEmpresas->getLista();


$carrossel = new Carrossel();
$imgs_carrossel = $carrossel->getLista();

$segs = new Segmentos();

include_once("head.php");
?>

<body id="main">

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="/home">
                        <span>
                            Melhores de Garanhuns
                        </span>
                    </a>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section ">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-7 col-md-8 mx-auto">
                        <div class="detail-box" >
                            <p>Empresa sem site cadastrado aqui!</p>
                            <h1>
                                Não tem um site? <br>
                            </h1>
                            <p>Crie um conosco, entre em contato.</p>
                            <p>(11) 95339-5785</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <!-- about section -->


    <!-- end about section -->

    <!-- job section -->
    
    <!-- end job section -->

    <!-- expert section -->

    
    <!-- end expert section -->

    <?php include_once("rodape.php"); ?>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- Custom js -->
    <script src="js/custom.js"></script>
    <script src="js/avaliacoes.js"></script>
    
    <?php
        if(isset($_GET['s']))
        {
        echo "<script>
                var targetOffset2 = $('#container-empresas').offset().top;

                $('html, body').animate({
                    scrollTop: targetOffset2
                }, 500);
            </script>";
        }
    ?>
</body>

</html>