<?php
    session_start();
    require 'conexao.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edição de cliente</title>
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
                    <h5>Edição de cliente
                            <a href="cad_usuarios.php?empresa=<?php echo $var3; echo "&perfil=$perfil"; echo "&origem=$origem";  ?>" class="btn btn-secondary float-end"><span class='bi bi-arrow-left-circle'></span>&nbsp;Voltar</a>
                    </h5>                        
                    </div>
                    <div class="card-body">
                        
                        <?php
                            if(isset($_GET['codigo'])){
                                $usuario_id = mysqli_real_escape_string($conexao, $_GET['codigo']);
                                $sql = "Select * from usuarios Where codigo='$usuario_id'";
                                $query = mysqli_query($conexao,$sql);

                                if(mysqli_num_rows($query) > 0){
                                    $usuario = mysqli_fetch_array($query);

                        ?>

                        <form action="acoes.php?empresa=<?php echo $var3; echo '&codigo='; echo $usuario_id; echo '&perfil='; echo $perfil; echo '&origem='; echo $origem ?>" method="POST">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" value="<?=$usuario['usuario']?>" required class="form-control">
                            </div>
                            
                            <?php
                                if($perfil=='adm'){
                                    echo "<div class='mb-3'>";
                                    echo "<label>Senha</label>";
                                    echo "<input type='text' name='senha' value=''";
                                    echo "required class='form-control'>";
                                    echo "</div>";
                                }
                            ?>

                            <div class="mb-3">
                                <label>Perfil</label>
                                <select id="cmbMake" name="perfil" value="" class="form-control" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
                                    <option value="">Selecione</option>
                                    <option value="adm">Admin</option>
                                    <option value="ope">Operador</option>
                               </select>

                               <input type="hidden" name="origem" id="origem" value=<?php echo $origem?> />
                                
                            <div class="mb-3">
                                <br>
                                <button type="submit" name="update_usuario" class="btn btn-primary"><span class='bi bi-check-circle'></span>&nbsp;Salvar</button>
                            </div>                            
                        </form>
                        <?php
                        } else {
                            echo "<h5>Usuário não encontrado</h5>";
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