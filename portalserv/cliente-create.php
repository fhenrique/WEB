<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criação de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    
    <?php
        include('navbar_clientes.php');
        $var3 = $_GET["empresa"];
        $perfil = $_GET["perfil"];
        $origem = $_GET["origem"];
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h5>Inclusão de cliente
                            <a href="cad_clientes.php?empresa=<?php echo $var3; echo "&perfil="; echo $perfil; echo "&origem="; echo $origem;?>" class="btn btn-secondary float-end"><span class='bi bi-arrow-left-circle'></span>&nbsp;Voltar</a>
                    </h5>                            
                    </div>
                    <div class="card-body">

                        <form action="acoes.php?empresa=<?php echo $var3; echo "&origem="; echo $origem ?>" method="POST">

                            <div class="mb-3">
                                <label>Nome</label>
                                <input autofocus type="text" name="nome" required class="form-control">
                            </div>
    
                            <div class="mb-3">
                                <label>Celular</label>
                                <input type="number" name="celular" required class="form-control">
                            </div>                            
                            
                            <div class="mb-3">
                                <label>Fone residencial</label>
                                <input type="number" name="foneres" class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>Fone comercial</label>
                                <input type="number" name="fonecom" class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>CPF</label>
                                <input type="number" name="cpf" required class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>CNPJ</label>
                                <input type="number" name="cnpj" class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>Atendente</label>
                                <input type="text" name="atendente" class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>E-mail</label>
                                <input type="text" name="email" class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>Solicitante</label>
                                <input type="text" name="solicitante" required class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>Contrato</label>
                                <input type="text" name="contrato" class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>Dt. Contrato</label>
                                <input type="date" name="dtcontrato" class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label>Observação</label>
                                <input type="text" name="obs"  class="form-control">
                            </div>                                                        

                            <div class="mb-3">
                                <br>
                                <button type="submit" name="create_cliente" class="btn btn-primary"><span class='bi bi-check-circle'></span>&nbsp;Salvar</button>
                            </div>                            



                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>