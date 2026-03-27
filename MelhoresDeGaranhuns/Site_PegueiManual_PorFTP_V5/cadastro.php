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
    <title>Cadastro | Melhores de Garanhuns</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <?php
                        $funcs->exibeAlertas();
                        ?>
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <!-- <img src="assets/images/favicon.svg" height="48" class='mb-4'> -->
                                <h3>Melhores de Garanhuns</h3>
                                <p>Por favor, preencha o registro.</p>
                            </div>
                            <form action="valida_cadastro.php" method="post">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nome</label>
                                            <input type="text" id="name-column" class="form-control validate" name="nome">
                                            <div class="alertaValidacao"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Email</label>
                                            <input type="text" id="email-column" class="form-control validate" name="email">
                                            <div class="alertaValidacao"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Telefone</label>
                                            <input type="text" id="email-column" class="form-control validate" name="telefone">
                                            <div class="alertaValidacao"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="username-column">Senha</label>
                                            <input type="password" id="pass-column" class="form-control validate" name="senha">
                                            <div class="alertaValidacao"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Confirmar Senha</label>
                                            <input type="password" id="conf-pass-column" class="form-control validate" name="conf-senha">
                                            <div class="alertaValidacao"></div>
                                        </div>
                                    </div>
                                </diV>

                                <a href="/login">Possui conta? Login</a>
                                <div class='clearfix my-4'>
                                    <div class="float-start">
                                        <a href="./home" class="btn btn-danger">Cancelar</a>
                                    </div>
                                    <div class="float-end">
                                        <button class="btn btn-primary float-end" type="button" id="butCadastro">Cadastrar</button>
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
    <script src="js/valida-registro.js"></script>
</body>

</html>