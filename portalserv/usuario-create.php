<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criação de Usuário</title>
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
                    <h5>Inclusão de usuário
                            <a href="cad_usuarios.php?empresa=<?php echo $var3; echo "&perfil="; echo $perfil; echo "&origem="; echo $origem;?>" class="btn btn-secondary float-end"><span class='bi bi-arrow-left-circle'></span>&nbsp;Voltar</a>
                    </h5>                            
                    </div>
                    <div class="card-body">

                        <form action="acoes.php?empresa=<?php echo $var3; echo "&perfil="; echo $perfil; echo "&origem="; echo $origem;?>" method="POST">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input autofocus type="text" name="nome" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Senha</label>
                                <input type="password" name="senha" required class="form-control">
                            </div>                            
                            
                            <div class="mb-3">
                                <label>Perfil</label>
                                <select id="cmbMake" name="perfil" class="form-control" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
                                    <option value="adm">Admin</option>
                                    <option value="ope">Operador</option>
                               </select>

                               <input type="hidden" name="selected_text" id="selected_text" value="" />
                                
                            <div class="mb-3">
                                <br>
                                <button type="submit" name="create_usuario" class="btn btn-primary"><span class='bi bi-check-circle'></span>&nbsp;Salvar</button>
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