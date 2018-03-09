<!-- menus modulo ciclos -->

<?php if($this->Logueo->permisosUsuario($this->session->userdata('id'),'v_versions')==true || $this->Logueo->permisosUsuario($this->session->userdata('id'),'v_plans')==true){?>
<li class="nav-item start <?php if ($this->uri->segment(1)== "Versions" || $this->uri->segment(1)== "Plans"){?>active open<?php }?>">
    <a href="#" class="nav-link nav-toggle" title="Planes y Versiones">
        <i class="fa fa-map-signs"></i>
        <span class="title">PLANES/VERSIONES</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <?php if($this->Logueo->permisosUsuario($this->session->userdata('id'),'v_plans')==true){?>
        <li class="nav-item start ">
            <a href="<?= base_url() ?>Plans" class="nav-link" title="listar planes">
                <i class="fa fa-map"></i>
                <span class="title">
                    Planes
                </span>
            </a>
        </li>
        <?php }?>
        <?php if($this->Logueo->permisosUsuario($this->session->userdata('id'),'v_versions')==true){?>
        <li class="nav-item start ">
            <a href="<?= base_url()?>Versions" class="nav-link" title="listar versiones">
                <i class="fa fa-clone"></i>
                <span class="title">
                    Versiones
                </span>
            </a>
        </li>
        <?php }?>
    </ul>
</li>
<?php }?>
<?php if($this->Logueo->permisosUsuario($this->session->userdata('id'),'v_cicles')==true){?>
<li class="nav-item start <?php if ($this->uri->segment(1)== "Cicles"){?>active open<?php }?>">
    <a href="<?= base_url() ?>Cicles" class="nav-link nav-toggle" title="Cursos/Ciclos">
        <i class="fa fa-cubes"></i>
        <span class="title">CURSOS/CICLOS</span>
        <span class="arrow"></span>
    </a>
</li>
<?php }?>
<!--end menus modulo ciclos -->
