<?php

/*
    if ($_SESSION['empresa'] == 'xsol'){
        $minha_empresa == 'xsol';
    }   
*/
    require_once 'conexao.php';
    $origem = $_GET["origem"];
    
    #CREATE USUARIO
    if (isset($_POST['create_usuario'])){
        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome'])); //$conexao está no conexao.php que foi chamado por require e 'nome' está no formulario do arquivo usuario-create.php
        $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
        $perfil = mysqli_real_escape_string($conexao, trim($_POST['perfil'])); 
        
        $empresa =  $_GET["empresa"];
        

        #Validando se o usuário já existe
        $mysqli = new mysqli("localhost", "root", "senha3762", "db_portalsolar"); 
        $result = $mysqli->query("Select * from usuarios Where usuario = '$nome' and empresa = '$empresa'");
        $qtdUsuarios = $result->num_rows;

        if($qtdUsuarios == 1){
        ?>

                <script>
                    alert("Já existe um usuário cadastrado com este nome, informe outro!");
                    history.back();
                </script>

        <?php
        }
        else{
            $sql = "INSERT INTO usuarios(usuario, senha, perfil, empresa) VALUES ('$nome','$senha','$perfil','$empresa')";
            mysqli_query($conexao,$sql);
?>
            <script>
                alert("O usuário foi criado  com sucesso!");
                window.location.href = "dashboard.php?perfil=<?php echo $perfil; echo '&origem='; echo $origem?>";
            </script>                    
<?php
            #header("cad_usuarios.php?empresa=".$empresa."&perfil=".$perfil."&origem=".$origem); exit;
            #header("cad_usuarios.php"); exit;


        }
    }

    #UPDATE USUARIO
    if (isset($_POST['update_usuario'])){

        $codigo = $_GET["codigo"];
        $perfil = $_GET["perfil"];

        $usuario_id = mysqli_real_escape_string($conexao, $codigo);

        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome'])); //$conexao está no conexao.php que foi chamado por require e 'nome' está no formulario do arquivo usuario-create.php
        $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
        $perfil = mysqli_real_escape_string($conexao, trim($_POST['perfil'])); 
        $origem = mysqli_real_escape_string($conexao, trim($_POST['origem']));

        $sql = "UPDATE usuarios SET usuario = '$nome', perfil = '$perfil'";

        if(!empty($senha)){
            $sql .= ", senha = '$senha'";
        }

        $sql .= " Where codigo = $usuario_id";


        mysqli_query($conexao,$sql);

        ?>
        
        <script>
            alert("O cadastro do usuário foi atualizado com sucesso!");
            window.location.href = "dashboard.php?perfil=<?php echo $perfil; echo '&origem='; echo $origem?>";
        </script>                    

        <?php

    }

    #EXCLUIR USUÁRIO
    if (isset($_POST['delete_usuario'])){
        $usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);
        #echo $usuario_id; exit;

        $sql="DELETE FROM usuarios Where Codigo=$usuario_id";
        mysqli_query($conexao,$sql);

        if(mysqli_affected_rows($conexao) > 0){
            ?>
            <script>
                alert("O cadastro do usuário foi excluído com sucesso!");
                window.location.href = "dashboard.php?perfil=<?php echo $origem; echo '&origem='; echo $origem?>";
            </script>                    
            <?php            
        }

    }

    #CREATE CLIENTE
    if (isset($_POST['create_cliente'])){
        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome'])); //$conexao está no conexao.php que foi chamado por require e 'nome' está no formulario do arquivo usuario-create.php
        $celular = mysqli_real_escape_string($conexao, trim($_POST['celular']));
        $foneres = mysqli_real_escape_string($conexao, trim($_POST['foneres'])); 
        $fonecom = mysqli_real_escape_string($conexao, trim($_POST['fonecom'])); 
        $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf'])); 
        $cnpj = mysqli_real_escape_string($conexao, trim($_POST['cnpj'])); 
        $atendente = mysqli_real_escape_string($conexao, trim($_POST['atendente'])); 
        $email = mysqli_real_escape_string($conexao, trim($_POST['email'])); 
        $solicitante = mysqli_real_escape_string($conexao, trim($_POST['solicitante'])); 
        $contrato = mysqli_real_escape_string($conexao, trim($_POST['contrato'])); 
        $dtcontrato = mysqli_real_escape_string($conexao, trim($_POST['dtcontrato'])); 
        #$tipo = mysqli_real_escape_string($conexao, trim($_POST['tipo'])); 
        
        if(!$dtcontrato){
            $dtpassado = strtotime("1900/01/01");
            $dtcontrato = date('Y-m-d',$dtpassado);
        }

        $datacadastro = date('Y/m/d');
        
        $empresa =  $_GET["empresa"];
        

        #Validando se o cliente já existe para a empresa
        $mysqli = new mysqli("localhost", "root", "senha3762", "db_portalsolar"); 
        $result = $mysqli->query("Select * from clientes Where nome = '$nome' and empresa = '$empresa'");
        $qtdClientes = $result->num_rows;

        if($qtdClientes == 1){
        ?>
            <script>
                alert("Já existe um cliente cadastrado com este nome, informe outro!");
            </script>
        <?php
        }
        else{
            $sql = "Insert into clientes(nome, fone_celular, fone_res, fone_com, cpf, cnpj, atendente, email, solicitante, contrato, dt_contrato, tipo, data_cadastro, empresa)";
            $sql = $sql."VALUES ('$nome','$celular','$foneres','$fonecom','$cpf','$cnpj','$atendente','$email','$solicitante','$contrato','$dtcontrato', 'C','$datacadastro','$empresa')";


            mysqli_query($conexao,$sql);

            ?>

            <script>
                alert("O cliente foi criado  com sucesso!");
                window.location.href = "dashboard.php?perfil=<?php echo $perfil; echo '&origem='; echo $origem?>";
            </script>                    

            <?php



        }
    }


?>    