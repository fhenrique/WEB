<?php
if(session_id() == "")
    session_start();

if(!isset($_SESSION['userID']))
    header("Location:/");

require_once("classes/funcoes.php");
require_once("classes/usuario.php");
require_once("classes/listaAvaliacoes.php");
$user = new Usuario();
$user->setIdExterno($_SESSION['userID']);
$user->select();

$pagina = explode("/",$_SERVER['REQUEST_URI']);
$pagina = explode(".php",$pagina[count($pagina)-1])[0];

$funcs = new Funcoes();

$lista = new ListaAvaliacoes();
$lista->setIdUsuario($user->getId());
$avaliacoes = $lista->getLista();
$naoAvaliados = $lista->getListaExcecao();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações  - Melhores de Garanhuns</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
    <!-- custom style -->
    <link href="css/avaliacoes.css" rel="stylesheet" />
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <?php include("menu-lateral-painel.php");?>
        </div>
        <div id="main">
            <?php include("menu-top-painel.php");?>

            <div class="main-content container-fluid">
                <?php $funcs->exibeAlertas(); ?>
                <div class="row match-height">
                <div class="page-title">
                    <h3>Suas Avaliações</h3>
                    <p class="text-subtitle text-muted">Aqui você pode editar suas avaliações sobre as empresas parceiras.</p>
                </div>
                <section class="section">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Suas Avaliações</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="alterar_senha.php" method="post">
                                            <div class="form-body">
                                                <div class="row">
                                                    <?php
                                                    $i = 0;
                                                    foreach($avaliacoes as $rate){
                                                    ?>
                                                    <div class="col-md-2 row-rate">
                                                        <label>
                                                            <b><?=ucwords(mb_strtolower($rate->empresa->getNome())) ;?></b>
                                                            <div id="load-<?=$i;?>"></div>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4 row-rate">
                                                        <?php for($j=1; $j<=5;$j++){ ?>
                                                        <label for="s<?=$j;?>-<?=$i;?>">
                                                            <a href="#" class="rate-star <?=$rate->getPontos() == $j?"clicado":"";?>" data-aval="<?=$i;?>">
                                                                <i class="fas fa-star"></i>
                                                                <?=$j;?>
                                                            </a>
                                                        </label>
                                                        <input type="radio" name="estrelas-<?=$i;?>" value="s<?=$j;?>-<?=$i;?>" id="s<?=$j;?>-<?=$i;?>" <?=$rate->getPontos() == $j?"checked":"";?>>
                                                        <?php } ?>
                                                        <input type="hidden" name="empresaRate-<?=$i;?>" value="<?=$rate->empresa->getId();?>">
                                                    </div>
                                                    <div class="col-md-6 row-rate">
                                                        <div class="alert" id="avisoEmpresa-<?=$i;?>"></div>
                                                    </div>
                                                    <?php 
                                                        $i++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Avalie Outras Empresas</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="row">
                                                <?php
                                                foreach($naoAvaliados as $naoRate){
                                                ?>
                                                <div class="col-md-2 row-rate">
                                                    <label>
                                                        <b><?=ucwords(mb_strtolower($naoRate->getNome())) ;?></b>
                                                        <div id="load-<?=$i;?>"></div>
                                                    </label>
                                                </div>
                                                <div class="col-md-4 row-rate">
                                                    <?php for($j=1; $j<=5;$j++){ ?>
                                                    <label for="s<?=$j;?>-<?=$i;?>">
                                                        <a href="#" class="rate-star" data-aval="<?=$i;?>">
                                                            <i class="fas fa-star"></i>
                                                            <?=$j;?>
                                                        </a>
                                                    </label>
                                                    <input type="radio" name="estrelas-<?=$i;?>" value="s<?=$j;?>-<?=$i;?>" id="s<?=$j;?>-<?=$i;?>">
                                                    <?php } ?>
                                                    <input type="hidden" name="empresaRate-<?=$i;?>" value="<?=$naoRate->getId();?>">
                                                </div>
                                                <div class="col-md-6 row-rate">
                                                    <div class="alert" id="avisoEmpresa-<?=$i;?>"></div>
                                                </div>
                                                <?php 
                                                    $i++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; Melhores de Garanhuns</p>
                    </div>
                    <div class="float-end">
                        <p></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="js/avaliacoes_painel.js"></script>
</body>

</html>