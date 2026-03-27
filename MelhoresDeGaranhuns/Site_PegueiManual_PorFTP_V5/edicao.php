<?php
if(session_id() == "")
    session_start();

if(!isset($_SESSION['userID']))
    header("Location:/");

require_once("classes/funcoes.php");
require_once("classes/usuario.php");
require_once("classes/segmentos.php");
require_once("classes/listaEmpresas.php");

$funcs = new Funcoes();
$user = new Usuario();
$user->setIdExterno($_SESSION['userID']);
$user->select();

if($user->getId() != 1)
header("Location:/perfil");

$segs = new Segmentos();

$pagina = explode("/",$_SERVER['REQUEST_URI']);
$pagina = explode(".php",$pagina[count($pagina)-1])[0];

$segs->allSegmentos();
$lista = $segs->getListaSegmentos();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração  - Melhores de Garanhuns</title>

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
                    <h3>Funções de Edição</h3>
                    <p class="text-subtitle text-muted">Área para edição de segmentos e empresas.</p>
                </div>
                <section class="section">
                    <div class="row match-height">
                    <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Editar Empresa</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="alertaEmpresa"></div>
                                        <form class="form form-horizontal" action="alterar_empresa.php" method="post" id="form-edit-empresa" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Selecione</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <select class="form-select" name="select-edit-empresa">
                                                                    <option value="">-</option>
                                                                    <?php
                                                                    $lista_empresas = new ListaEmpresas();

                                                                    foreach($lista_empresas->getLista() as $empresa){
                                                                    ?>
                                                                        <option value="<?=$empresa->getId();?>"><?=ucwords($empresa->getNome());?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Nome da Empresa</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Nome da Empresa" name="nome-edit-empresa">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Telefone</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Telefone da Empresa" name="telefone-edit-empresa">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Endereço</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Endereço da Empresa" name="endereco-edit-empresa">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Link</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Site da Empresa" name="link-edit-empresa">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Segmento</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <select class="form-select" name="segmento-edit-empresa">
                                                                    <option value="">-</option>
                                                                    <?php
                                                                    foreach($lista as $s){
                                                                    ?>
                                                                        <option value="<?=$s['id'];?>"><?=ucwords($s['nome']);?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Descrição</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <textarea class="form-control" rows="3" name="descricao-edit-empresa"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="col-12 d-flex justify-content-end ">
                                                    <button type="button" class="btn btn-primary me-1 mb-1">Alterar Dados</button>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                        
                                        <h4 class="card-title">Alterar Logotipo</h4>
                                        <form action="alterar_imagem_empresa.php" method="post" id="form-edit-logo-empresa" enctype="multipart/form-data">
                                            <div class="col-md-4">
                                                <label></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="form-file">
                                                    <input type="hidden" name="select-edit-logo-empresa">
                                                        <input style="font-size:12px" type="file" class="form-file-input" name="logo"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end ">
                                                <button type="button" class="btn btn-primary me-1 mb-1">Alterar Logo</button>
                                            </div>
                                        </form>
                                        <h4 class="card-title">Excluir Empresa</h4>
                                        <form action="delete_empresa.php" method="post" id="form-delete-empresa">
                                            <div class="col-md-12">
                                                <label>Para confirmar a exclusão da empresa digite: <b id="tag-empresa-delete"></b></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <input type="text" name="confirm-delete-empresa">
                                                    <input type="hidden" name="select-del-empresa">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end ">
                                                <button type="button" class="btn btn-danger me-1 mb-1">Excluir Empresa</button>
                                            </div>
                                        </form>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Editar Segmento</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="alertaSegmento"></div>
                                        <form class="form form-horizontal" method="post" action="alterar_segmento.php" id="form-segmento">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Segmento</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <select class="form-select" name="segmento">
                                                                <option value="">-</option>
                                                                <?php
                                                                foreach($lista as $s){
                                                                ?>
                                                                    <option value="<?=$s['id'];?>"><?=ucwords($s['nome']);?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Novo Nome</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Novo nome do Segmento" name="novo-segmento">
                                                                <div class="form-control-icon">
                                                                    <i data-feather="layers"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end ">
                                                        <button type="button" class="btn btn-primary me-1 mb-1">Alterar</button>
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

    <script src="js/edit_empresa.js"></script>
    <script src="js/valida_segmento.js"></script>
</body>

</html>