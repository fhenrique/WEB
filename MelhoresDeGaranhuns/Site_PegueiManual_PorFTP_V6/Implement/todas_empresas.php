<?php
if(session_id() == "")
  session_start();

include_once("classes/usuario.php");
include_once("classes/alertas.php");
include_once("classes/listaEmpresas.php");
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

$segs = new Segmentos();

include_once("head.php");
?>
<body class="sub_page" id="main">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
              Melhores de Garanhus
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="/home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/home#container-about">Sobre</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link scroll-link" href="./empresas">Empresas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/home#container-top">Top</a>
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
  </div>

  <!-- job section -->
  <section class="job_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Melhores de Garanhuns
        </h2>
      </div>
      <?php $funcs->exibeAlertas(); ?>
      <div class="job_container">
        <h4 class="job_heading">
          Baseado na Satisfação e Votação dos Consumidores
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
                <button type="button" class="apply-btn but-avaliacao" data-bus="<?=$empresas[$emp]->getId();?>">
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
      <div class="modal fade" id="avaliacoes" tabindex="-1" role="dialog" aria-labelledby="avaliacoesLabel" aria-hidden="true">
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
              <input type="hidden" name="origem" value="empresas">
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
    </div>
  </section>
  <!-- end job section -->

  <?php include_once("rodape.php"); ?>

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <script src="js/avaliacoes.js"></script>

</body>

</html>