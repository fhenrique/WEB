<?php
    require 'conexao.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">        
  </head>
  <body>
    <?php
        include('navbar.php');

        if (isset($_GET["empresa"])) {
            $var2 = $_GET["empresa"];
        }else{
            $var2;
        }        

        if (isset($_GET["perfil"])) {
            $perfil = $_GET["perfil"];
        }else{
            $perfil;
        }        

        if (isset($_GET["origem"])) {
            $origem = $_GET["origem"];
        }else{
            $origem;
        }        

    ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Usuários
                        <a href="dashboard.php?perfil=<?php echo $perfil;?>" class="btn btn-secondary float-end"><span class="bi bi-arrow-left-circle"></span>&nbsp;Voltar</a>
                        <a href="" class="btn btn-link float-end">    </a>
                        <a href="usuario-create.php?empresa=<?php echo $var2; echo "&perfil="; echo $perfil; echo "&origem="; echo $origem?>" class="btn btn-primary float-end"><span class="bi bi-plus-circle"></span>&nbsp;Adicionar usuário</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Perfil</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "Select * from usuarios";
                                $usuarios = mysqli_query($conexao,$sql);
                                if (mysqli_num_rows($usuarios) > 0) {
                                    foreach($usuarios as $usuario){
                                ?>
                                <tr>
                                    <td><?=$usuario['usuario']?></td>
                                    <td><?=$usuario['perfil']?></td>
                                    <td>
                                        
                                        
                                        <a href="usuario-edit.php?codigo=<?=$usuario['codigo']; echo "&empresa=$var2&perfil=$perfil&origem=$origem";  ?>" class="btn btn-success btn-sm"><span class="bi bi-pencil"></span>&nbsp; Editar</a>

                                        <form action="acoes.php?codigo=<?=$usuario['codigo'];echo "&perfil=$perfil"; echo "&origem=$origem"?>" method="POST" class="d-inline">
                                            <button onclick="return confirm('Tem certeza que deseja excluir o usuário?')" type="submit" name="delete_usuario" value="<?=$usuario['codigo']?>" class="btn btn-danger btn-sm">
                                            <span class="bi bi-x-circle"></span>&nbsp;Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                } }else{
                                    echo '<h5>Nenhum usuário encontrado!</h5>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </body>
</html>