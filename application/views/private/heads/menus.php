<!-- menus dashboard -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start ">
                <a href="<?= base_url('index.php/Usuarios/perfil') ?>" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">PERFIL</span>
                                <span class="arrow"></span>
                            </a>
            </li>
            <li class="nav-item start ">
                <a href="<?= base_url('index.php/Usuarios/listarUsuarios') ?>" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">USUARIOS</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="<?= base_url('index.php/Usuarios/listarUsuarios') ?>" class="nav-link ">
                            <i class="icon-list">
                            </i>
                            <span class="title">
                                Listar
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start ">
                <a href="" class="nav-link nav-toggle">
                    <i class="icon-lock"></i>
                    <span class="title">ROLES/PERMISOS</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="<?= base_url('index.php/Usuarios/listarUsuarios') ?>" class="nav-link ">
                            <i class="fa fa-group">
                            </i>
                            <span class="title">
                                roles
                            </span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?= base_url('index.php/Usuarios/listarUsuarios') ?>" class="nav-link ">
                            <i class="fa fa-hand-lizard-o">
                            </i>
                            <span class="title">
                               asignacion roles
                            </span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?= base_url('index.php/Usuarios/listarUsuarios') ?>" class="nav-link ">
                            <i class="fa fa-language">
                            </i>
                            <span class="title">
                                permisos
                            </span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="<?= base_url('index.php/Usuarios/listarUsuarios') ?>" class="nav-link ">
                            <i class="fa fa-eye-slash">
                            </i>
                            <span class="title">
                               asignacion permisos
                            </span>
                        </a>
                    </li>
                </ul>

            </li>
        </ul>
    </div>
</div>
<!--end menus dashboard -->
