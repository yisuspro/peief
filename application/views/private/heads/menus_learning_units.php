<!-- menus modulo ciclos -->
<?php if($this->Logueo->permisosUsuario($id,'v_enfoques')==true){?>
<li class="nav-item start <?php if ($this->uri->segment(1)== "Focus"){?>active open<?php }?>">
    <a href="<?= base_url('index.php/Focus') ?>" class="nav-link nav-toggle" title="Cursos/Ciclos">
        <i class="fa fa-tripadvisor"></i>
        <span class="title">ENFOQUES PEDAGOGICOS</span>
        <span class="arrow"></span>
    </a>
</li>
<?php }?>
<?php if($this->Logueo->permisosUsuario($id,'v_versions')==true || $this->Logueo->permisosUsuario($id,'v_plans')==true){?>
<li class="nav-item start <?php if ($this->uri->segment(1)== "Learning_Units"){?>active open<?php }?>">
    <a href="#" class="nav-link nav-toggle" title="Planes y Versiones">
        <i class="fa fa-graduation-cap"></i>
        <span class="title">UNIDADES DE APRENDIZAJE</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <?php if($this->Logueo->permisosUsuario($id,'v_plans')==true){?>
        <li class="nav-item start ">
            <a href="<?= base_url('index.php/Plans') ?>" class="nav-link" title="listar planes">
                <i class="fa fa-map"></i>
                <span class="title">
                    Planes
                </span>
            </a>
        </li>
        <?php }?>
        <?php if($this->Logueo->permisosUsuario($id,'v_versions')==true){?>
        <li class="nav-item start ">
            <a href="<?= base_url('index.php/Versions') ?>" class="nav-link" title="listar versiones">
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
<?php if($this->Logueo->permisosUsuario($id,'v_cicles')==true){?>
<li class="nav-item start <?php if ($this->uri->segment(1)== "Subjects"){?>active open<?php }?>">
    <a href="#" class="nav-link nav-toggle" title="Cursos/Ciclos">
        <i class="fa fa-tasks"></i>
        <span class="title">ASIGNATURAS</span>
        <span class="arrow"></span>
    </a>
</li>
<?php }?>
<!--end menus modulo ciclos -->
