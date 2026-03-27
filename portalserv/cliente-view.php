<?php
    session_start();
    require 'conexao.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualização de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    
    <?php
        include('navbar.php');
        $var3 = $_GET["empresa"];
        $perfil = $_GET["perfil"];
        $origem = $_GET["origem"];
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h5>Visualizar usuário
                            <a href="cad_clientes.php?empresa=<?php echo $var3; echo "&perfil="; echo $perfil; echo "&origem="; echo $origem;?>" class="btn btn-secondary float-end"><span class='bi bi-arrow-left-circle'></span>&nbsp;Voltar</a>
                    </h5>                            
                    </div>
                    <div class="card-body">

                            <?php
                                if (isset($_GET['codigo'])){
                                    $cliente_codigo = mysqli_real_escape_string($conexao, $_GET['codigo']);
                                    $sql = "SELECT * from clientes where codigo = '$cliente_codigo'";
                                    $query = mysqli_query($conexao, $sql);

                                    if(mysqli_num_rows($query) > 0){
                                        $cliente = mysqli_fetch_array($query);


                            ?>
                        
                            <div class="mb-3">
                                <label>Nome</label>
                                <p class='form-control';>
                                    <?=$cliente['nome'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Celular</label>
                                <p class='form-control';>
                                    <?=$cliente['fone_celular'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Fone residencial</label>
                                <p class='form-control';>
                                    <?=$cliente['fone_res'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Fone comercial</label>
                                <p class='form-control';>
                                    <?=$cliente['fone_com'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>CPF</label>
                                <p class='form-control';>
                                    <?=$cliente['cpf'];?>
                                </p>
                            </div>                            

                            <div class="mb-3">
                                <label>CNPJ</label>
                                <p class='form-control';>
                                    <?=$cliente['cnpj'];?>
                                </p>
                            </div>                            

                            <div class="mb-3">
                                <label>Atendente</label>
                                <p class='form-control';>
                                    <?=$cliente['atendente'];?>                                    
                                </p>
                            </div>              
                            
                            <div class="mb-3">
                                <label>E-mail</label>
                                <p class='form-control';>
                                    <?=$cliente['email'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Solicitante</label>
                                <p class='form-control';>
                                    <?=$cliente['solicitante'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Contrato</label>
                                <p class='form-control';>
                                    <?=$cliente['contrato'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Data de contrato</label>
                                <p class='form-control';>
                                    <?=$cliente['dt_contrato'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Arquivo morto</label>
                                <p class='form-control';>
                                    <?=$cliente['arquivo_morto'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Justificativ</label>
                                <p class='form-control';>
                                    <?=$cliente['arquivo_morto_justificativa'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Tipo</label>
                                <p class='form-control';>
                                    <?=$cliente['tipo'];?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label>Data de cadastro</label>
                                <p class='form-control';>
                                    <?=$cliente['data_cadastro'];?>
                                </p>
                            </div>

                            <?php
                                }else{
                                    echo "<h5>Cliente não encontrado</h5>";
                                }
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>