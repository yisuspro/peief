<!-- menus dashboard -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start <?php if ($this->uri->segment(2)== "perfil"){?>active open<?php }?>">
                <a href="<?= base_url('index.php/Usuarios/perfil') ?>" class="nav-link nav-toggle" title="perfil">
                    <i class="icon-user"></i>
                    <span class="title">PERFIL</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <?php if($this->Logueo->permisosUsuario($id,'v_users')==true){?>
            <li class="nav-item start <?php if ($this->uri->segment(2)== "listarUsuarios"){?>active open<?php }?>">
                <a href="<?= base_url('index.php/Usuarios/listarUsuarios') ?>" class="nav-link nav-toggle" title="listar usuarios">
                    <i class="icon-users"></i>
                    <span class="title">USUARIOS</span>
                    <span class="arrow"></span>
                </a></li>
            <?php }?>
            
             <?php if($this->Logueo->permisosUsuario($id,'v_permit')==true || $this->Logueo->permisosUsuario($id,'v_roles')==true){?>
            <li class="nav-item start <?php if ($this->uri->segment(1)== "Roles" || $this->uri->segment(1)== "Permisos" ){?>active open<?php }?>">
                <a href="#" class="nav-link nav-toggle" title="roles y permisos">
                    <i class="glyphicon glyphicon-minus-sign" ></i>
                    <span class="title">ROLES/PERMISOS</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <?php if($this->Logueo->permisosUsuario($id,'v_roles')==true){?>
                    <li class="nav-item start ">
                        <a href="<?= base_url('index.php/Roles') ?>" class="nav-link" title="listar roles">
                            <i class="fa fa-group">
                            </i>
                            <span class="title">
                                roles
                            </span>
                        </a>
                    </li>
                    <?php }?>
                    
                    <?php if($this->Logueo->permisosUsuario($id,'v_permit')==true){?>
                    <li class="nav-item start ">
                        <a href="<?= base_url('index.php/Permisos') ?>" class="nav-link" title="listar permisos">
                            <i class="fa fa-language">
                            </i>
                            <span class="title">
                                permisos
                            </span>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </li>
            <?php }?>
            <?php if($this->session->userdata('v_notas')){?>
            <li class="nav-item start <?php if ($this->uri->segment(2)== "listarUsuarios"){?>active open<?php }?>">
                <a href="<?= base_url('index.php/Usuarios/listarUsuarios') ?>" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Notas</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <?php }?>
            <?php require_once 'menus_cicles.php'; ?>
            <?php require_once 'menus_learning_units.php'; ?>
        </ul>
        
    </div>
</div>


<!--end menus dashboard -->
