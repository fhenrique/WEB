<?php
if(session_id() == "")
    session_start();

if(!isset($_SESSION['userID']))
    header("Location:/");

require_once("classes/funcoes.php");
require_once("classes/usuario.php");
$user = new Usuario();
$user->setIdExterno($_SESSION['userID']);
$user->select();

$pagina = explode("/",$_SERVER['REQUEST_URI']);
$pagina = explode(".php",$pagina[count($pagina)-1])[0];

$funcs = new Funcoes();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil  - Melhores de Garanhuns</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
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
                    <h3>Seu Perfil</h3>
                    <p class="text-subtitle text-muted">Aqui você pode editar suas informações.</p>
                </div>
                <section class="section">
                    <div class="row match-height">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Suas informações cadastrais</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" method="post" action="alterar_perfil.php">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Nome</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Nome" name="nome-edit" value="<?=ucwords($user->getNomeCompleto());?>">
                                                                <div class="form-control-icon">
                                                                    <i data-feather="user"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="email" class="form-control" placeholder="Email" value="<?=$user->getEmail();?>" readonly>
                                                                <div class="form-control-icon">
                                                                    <i data-feather="mail"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Telefone</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="text" name="telefone-edit" class="form-control" value="<?=$user->getTelefone();?>"  placeholder="Telefone">
                                                                <div class="form-control-icon">
                                                                    <i data-feather="phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="col-12 d-flex justify-content-end ">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Alterar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Alterar senha</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="alterar_senha.php" method="post">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Senha Atual</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="password" class="form-control" placeholder="Senha Atual" name="atual-pass">
                                                                <div class="form-control-icon">
                                                                    <i data-feather="lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Nova Senha</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="password" class="form-control" placeholder="Nova Senha" name="novo-pass">
                                                                <div class="form-control-icon">
                                                                    <i data-feather="lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Confirmar Nova Senha</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="password" class="form-control" placeholder="Confirmar Nova Senha" name="conf-novo-pass">
                                                                <div class="form-control-icon">
                                                                    <i data-feather="lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="col-12 d-flex justify-content-end ">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Alterar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
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
</body>

</html>