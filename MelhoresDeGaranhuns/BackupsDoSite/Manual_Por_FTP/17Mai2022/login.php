<?php
if(session_id() == "")
session_start();

if(isset($_SESSION['userID']))
header("Location:/");

require_once("classes/funcoes.php");

$funcs = new Funcoes();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Melhores de Garanhuns</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <?php
                        $funcs->exibeAlertas();
                        ?>
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <!-- <img src="assets/images/favicon.svg" height="48" class='mb-4'> -->
                                <h3>Melhores de Garanhuns</h3>
                                <p>Entre para continuar.</p>
                            </div>
                            <form action="valida_login.php" method="post">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Email</label>
                                    <div class="position-relative">
                                        <input type="email" class="form-control" id="usermail" name="email">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Senha</label>
                                        <a href="/recuperar-senha" class='float-end'>
                                            <small>Esqueceu sua Senha?</small>
                                        </a>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="userpass" name="pass">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class='form-check clearfix my-4'>
                                    <div class="checkbox float-start">
                                        <!-- <input type="checkbox" id="checkbox1" class='form-check-input'>
                                        <label for="checkbox1">Remember me</label> -->
                                    </div>
                                    <div class="float-end">
                                        <a href="/cadastro">Ainda não tem conta?</a>
                                    </div>
                                </div>
                                <div class='clearfix my-4'>
                                    <div class="float-start">
                                        <a href="./home" class="btn btn-danger">Cancelar</a>
                                    </div>
                                    <div class="float-end">
                                        <button class="btn btn-primary">Entrar</button>
                                    </div>
                                </div>
                            </form>
                            <!-- <div class="divider">
                                <div class="divider-text">OU</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-block mb-2 btn-primary"><i data-feather="facebook"></i>
                                        Facebook</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-block mb-2 btn-secondary"><i data-feather="github"></i>
                                        Github</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>