            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <!-- <img src="../assets/images/logo.svg" alt="" srcset=""> -->
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item">
                            <a href="/" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Página Inicial</span>
                            </a>

                        </li>

                        <li class='sidebar-title'>Bem vindo, <?=$user->getNome();?></li>

                        <li class="sidebar-item <?=$pagina=="perfil"?"active":"";?>">
                            <a href="/perfil" class='sidebar-link'>
                                <i data-feather="user" width="20"></i>
                                <span>Perfil</span>
                            </a>

                        </li>

                        <li class="sidebar-item <?=$pagina=="avaliacoes"?"active":"";?>">
                            <a href="/avaliacoes" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i>
                                <span>Avaliações</span>
                            </a>

                        </li>

                        <li class="sidebar-item">
                            <a href="/logout" class='sidebar-link'>
                                <i data-feather="log-out" width="20"></i>
                                <span>Sair</span>
                            </a>

                        </li>

                        <?php
                        if($user->getId() == 1){
                            $admin = FALSE;

                            switch($pagina){
                                case "adicao":
                                case "edicao":
                                case "exclusao":
                                    $admin = TRUE;
                                    break;
                                default:
                                    $admin = FALSE;
                                    break;
                            }
                        ?>
                        <li class='sidebar-title'>Funções Administrativas</li>
                        <li class="sidebar-item has-sub <?=$admin?"active":"";?>">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="file-plus" width="20"></i>
                                <span>Empresas/Segmentos</span>
                            </a>

                            <ul class="submenu ">
                                <li>
                                    <a href="/adicao">Adicionar</a>
                                </li>
                                <li>
                                    <a href="/edicao">Editar</a>
                                </li>
                            </ul>

                        </li>

                        <li class="sidebar-item <?=$pagina=="carrossel"?"active":"";?>">
                            <a href="/carrossel" class='sidebar-link'>
                                <i data-feather="file-plus" width="20"></i>
                                <span>Carrossel</span>
                            </a>
                        </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>