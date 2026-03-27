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

if(isset($_GET["s"]) && !empty($_GET["s"])){
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
                            
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link scroll-link" href="./">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll-link" href="#container-about">Informações</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll-link" href="#container-empresas">Empresas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll-link" href="#container-top">Top</a>
                            </li>
                            <?php
              if(!isset($_SESSION['userID'])){
              ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span>
                                        Entrar
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/cadastro">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span>
                                        Cadastrar
                                    </span>
                                </a>
                            </li>
                            <?php
              }else{
              ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/perfil">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span>
                                        <?=$usuario->getNome();?>
                                    </span>
                                </a>
                            </li>
                            <?php
              }
              ?>
                        </ul>
                    </div>
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
                            <h1>
                                DÊ "SUA" AVALIAÇÃO PARA <br>
                                AS EMPRESAS DA CIDADE
                            </h1>
                            <p>
                                Aqui as avaliações fortalecem a qualidade dos serviços prestados!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <!-- about section -->

    <section class="about_section layout_padding" id="container-about">
        <div class="container">
            <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <?php
                  $imgs_ = 0;
                  foreach($imgs_carrossel as $img)
                  {
                    if($img->getAtivo() > 0)
                    {
                      if($imgs_ > 0)
                      {
                        echo "<li data-target=\"#carouselIndicators\" data-slide-to=\"$imgs_\"></li>";
                      }else
                      {
                        echo "<li data-target=\"#carouselIndicators\" data-slide-to=\"0\" class=\"active\"></li>";
                      }

                      $imgs_++;
                    }
                  }
                  ?>
                </ol>
                <div class="carousel-inner">
                  <?php
                  $cont_lista_img = 0;
                  foreach($imgs_carrossel as $img)
                  {
                    if($img->getAtivo() > 0)
                    {
                      if($cont_lista_img > 0)
                      {
                        echo "
                        <div class=\"carousel-item\">
                            <img src=\"".$img->getCaminho()."\" class=\"d-block w-100\">
                        </div>
                        ";
                      }else
                      {
                        echo "
                        <div class=\"carousel-item active\">
                          <img src=\"".$img->getCaminho()."\" class=\"d-block w-100\" >
                        </div>
                        ";
                        $cont_lista_img++;
                      }
                    }
                  }
                  ?>
                </div>
                <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- job section -->
    <section class="job_section layout_padding" id="container-empresas">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Melhores de Garanhuns
                </h2>
            </div>
            <?php $funcs->exibeAlertas(); ?>
            <div class="job_container">
                <h4 class="job_heading">
                    Baseado na Satisfação e avaliação dos Clientes e Consumidores
                </h4>
                <br>
                    Selecione o Segmento: <select name="s">
                        <option value="">Todos</option>
                <?php
                $segs->allSegmentos();
                $lista = $segs->getListaSegmentos();

                foreach($lista as $s){
                ?>
                        <option value="<?=$s['id'];?>" <?=$_GET["s"] == $s['id'] ? "selected" : "" ?>><?=ucwords($s['nome']);?></option>
                <?php
                }
                ?>
                    </select>
                <?php
        $limite = 10;
        $qtd_empresas = count($empresas) <= $limite ? count($empresas) : $limite;

        $qtd_linhas = ceil($qtd_empresas/2);
        
        for($i = 0; $i < $qtd_empresas; $i+=2){
        ?>
                <div class="row">
                    <?php
          for($emp = $i; $emp <= $i+1; $emp++){
            if(isset($empresas[$emp])){
          ?>
                    <div class="col-lg-6">
                        <div class="box">
                            <div class="job_content-box">
                                <div class="img-box">
                                    <?php
                                    if(file_exists($empresas[$emp]->getImagem())){
                                        $caminho = $empresas[$emp]->getImagem();
                                    }else{
                                        $caminho = "images/noimage.png";
                                    }
                                    ?>
                                    <?php if($empresas[$emp]->getLink() != ""): ?>
                                        <a href="<?=$empresas[$emp]->getLink();?>" target="_blank"><img src="<?=$caminho;?>" alt=""></a>
                                    <?php else: ?>
                                        <img src="<?=$caminho;?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        <?=ucwords($empresas[$emp]->getNome());?>
                                    </h5>
                                    <div class="detail-info">
                                        <h6>
                                            <span>
                                                <?=ucwords($empresas[$emp]->getSegmento()->getSegmento());?>
                                            </span>
                                        </h6>
                                    </div>
                                    <div class="detail-info">
                                        <h6>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span>
                                                <?=ucwords($empresas[$emp]->getEndereco());?>
                                            </span>
                                        </h6>
                                    </div>
                                    <div class="detail-info">
                                        <h6>
                                            <i class="fas fa-phone-alt"></i>
                                            <span>
                                                <?=$empresas[$emp]->getTelefone();?>
                                            </span>
                                        </h6>
                                    </div>
                                    <div class="detail-info">
                                        <h6>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <span>
                                                <?=$empresas[$emp]->getPontos();?>
                                            </span>
                                        </h6>
                                    </div>
                                    <div class="detail-info">
                                        <h6>
                                            <i class="fas fa-user-circle" aria-hidden="true"></i>
                                            <span>
                                                <?=$empresas[$emp]->getNAvaliacoes();?> Avaliações
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="option-box">
                                <button type="button" class="apply-btn but-avaliacao"
                                    data-bus="<?=$empresas[$emp]->getId();?>">
                                    Avaliar
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
            }
          }
          ?>
                </div>
                <?php
        }
        ?>
            </div>
            <!-- Modal Avaliações -->
            <div class="modal fade" id="avaliacoes" tabindex="-1" role="dialog" aria-labelledby="avaliacoesLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="avaliacoesLabel"><b><span id="nome_empresa"></span></b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="validar_avaliacao.php">
                            <div class="modal-body">
                                <?php if(isset($_SESSION['userID']) && $_SESSION['userID'] != ""){ ?>
                                <label for="s1">
                                    <a href="#" class="rate-star">
                                        <i class="fas fa-star"></i>
                                        1
                                    </a>
                                </label>
                                <input type="radio" name="estrelas" value="s1" id="s1">

                                <label for="s2">
                                    <a href="#" class="rate-star">
                                        <i class="fas fa-star"></i>
                                        2
                                    </a>
                                </label>
                                <input type="radio" name="estrelas" value="s2" id="s2">

                                <label for="s3">
                                    <a href="#" class="rate-star">
                                        <i class="fas fa-star"></i>
                                        3
                                    </a>
                                </label>
                                <input type="radio" name="estrelas" value="s3" id="s3">

                                <label for="s4">
                                    <a href="#" class="rate-star">
                                        <i class="fas fa-star"></i>
                                        4
                                    </a>
                                </label>
                                <input type="radio" name="estrelas" value="s4" id="s4">

                                <label for="s5">
                                    <a href="#" class="rate-star">
                                        <i class="fas fa-star"></i>
                                        5
                                    </a>
                                </label>
                                <input type="radio" name="estrelas" value="s5" id="s5">

                                <input type="number" name="empresaRate">
                                <input type="hidden" name="origem" value="home">
                                <?php }else{ ?>
                                <p>Para avaliar as empresas é necessário estar logado.</p>
                                <?php } ?>
                            </div>
                            <div class="modal-footer">
                                <?php if(isset($_SESSION['userID']) && $_SESSION['userID'] != ""){ ?>
                                <button type="button" class="btn btn-primary" id="confRate">Avaliar</button>
                                <?php }else{ ?>
                                <a href="/login">Entre para continuar</a>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="./empresas">
                    Ver Tudo
                </a>
            </div>
        </div>
    </section>
    <!-- end job section -->

    <!-- expert section -->

    <section class="expert_section layout_padding" id="container-top">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    DETALHES DAS EMPRESAS TOP 3
                </h2>
                <p>
                    Confira aqui mais detalhes sobre as empresas no topo do nosso ranking.
                </p>
            </div>
            <div class="row">
                <?php
        if($qtd_empresas > 3){
          $qtd_empresas = 3;
        }
        for($j = 0; $j < $qtd_empresas; $j++){
          if(isset($empresas[$j])){
            ?>
                <div class="col-md-6 col-lg-4 mx-auto">
                    <div class="box">
                        <div class="img-box" style="min-height:150px;">
                            <?php
                                if(file_exists($empresas[$j]->getImagem())){
                                    $caminhoTop = $empresas[$j]->getImagem();

                                }else{
                                    $caminhoTop = "images/noimage.png";
                                }
                            ?>
                            <img style="width:50%;margin-left:25%;margin-top:25px;" src="<?=$caminhoTop;?>" alt="">
                        </div>
                        <div class="detail-box" style="min-height:100px;">
                            <a href="">
                                <?=ucwords($empresas[$j]->getNome());?>
                            </a>
                            <h6 class="expert_position">
                                <span>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <?=ucwords($empresas[$j]->getEndereco());?>
                                </span>
                            </h6>
                            <span class="expert_position">
                                <span>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <?=$empresas[$j]->getPontos();?>
                                </span>
                            </span>
                            <span class="expert_position">
                                <span>
                                    <i class="fas fa-user-circle" aria-hidden="true"></i>
                                    <?=$empresas[$j]->getNAvaliacoes();?> Avaliações
                                </span>
                            </span>
                            <p>
                                <?=ucfirst($empresas[$j]->getDescricao());?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
          }
        }
        ?>
            </div>
            <div class="btn-box">
                <a href="./empresas">
                    Ver todas Empresas
                </a>
            </div>
        </div>
    </section>

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
    if(isset($_GET['s'])){
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