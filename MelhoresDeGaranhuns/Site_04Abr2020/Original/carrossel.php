<?php
if(session_id() == "")
    session_start();

if(!isset($_SESSION['userID']))
    header("Location:/");

require_once("classes/funcoes.php");
require_once("classes/usuario.php");
require_once("classes/segmentos.php");

$funcs = new Funcoes();
$user = new Usuario();
$user->setIdExterno($_SESSION['userID']);
$user->select();

if($user->getId() != 1)
header("Location:/perfil");

$segs = new Segmentos();

$pagina = explode("/",$_SERVER['REQUEST_URI']);
$pagina = explode(".php",$pagina[count($pagina)-1])[0];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Melhores de Garanhuns</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
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
                    <h3>Funções de Carrossel</h3>
                    <p class="text-subtitle text-muted">Área para adição de imagens para o carrossel.</p>
                </div>
                <section class="section">
                    <div class="row match-height">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Nova Imagem (Upload)</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                    <form class="form form-horizontal" action="valida_imagem_carrossel.php" method="post" enctype="multipart/form-data" id="form-nova-empresa">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-file">
                                                <input type="file" class="form-file-input" id="customFile" name="imgCarrossel" required>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-12 d-flex justify-content-end ">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Adicionar</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Nova Imagem (Link)</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                    <form class="form form-horizontal" action="validar_link_imagem.php" method="post" id="form-link-imagem">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="position-relative">
                                                    <textarea class="form-control" name="linkImagem" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end ">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Adicionar</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Alterar Banner (Home)</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                    <form class="form form-horizontal" action="altera_imagem_home.php" method="post" enctype="multipart/form-data" id="form-nova-home">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-file">
                                                <input type="file" class="form-file-input" id="customFile" name="imgHome" required>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-12 d-flex justify-content-end ">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Adicionar</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Lista de Imagens</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>CAMINHO</th>
                                                <th>EXIBIÇÃO</th>
                                                <th></th>
                                                <th></th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                include_once("classes/carrossel.php");
                                $carrossel = new Carrossel();
                                $imgs_carrossel = $carrossel->getLista();

                                ?>
                                <?php
                                $cont_lista_img = 0;
                                foreach($imgs_carrossel as $img)
                                {
                                    if($img->getAtivo() > 0)
                                    {
                                        $ativo = "<span class=\"badge bg-success\">Ativo</span>";
                                    }else{
                                        $ativo = "<span class=\"badge bg-danger\">Inativo</span>";
                                    }

                                    $limite_str = 50;
                                    $caminhoFull = $img->getCaminho();
                                    if(strlen($caminhoFull) > 50)
                                    {
                                        $caminho = substr($caminhoFull,0,50)."...";
                                    }else
                                    {
                                        $caminho = $caminhoFull;
                                    }
                                ?>
                                            <tr>
                                                <td><?=$img->getId();?></td>
                                                <td><?=$caminho;?></td>
                                                <td><?=$ativo;?></td>
                                                
                                                <form action="alterar_carrossel.php" method="post">
                                                
                                                <input type="hidden" value="<?=$img->getId();?>" name="idImg">
                                                <td><button type="submit" name="status" value="1" class="btn btn-success" title="Ativar"><i class="fas fa-check"></i></button></td>
                                                <td><button type="submit" name="status" value="0" class="btn btn-danger" title="Desativar"><i class="fas fa-ban"></i></button></td>
                                                
                                                </form>
                                                
                                                <!-- <td><button class="btn btn-warning" title="Excluir"><i class="fas fa-trash"></i></button></td> -->
                                            </tr>
                                <?php
                                }
                                ?>
                                        </tbody>
                                    </table>
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
    
    <script src="js/valida_empresa.js"></script>
    <script src="js/valida_segmento.js"></script>
</body>

</html>