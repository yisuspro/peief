<!-- menus modulo ciclos -->
<?php if($this->Logueo->permisosUsuario($this->session->userdata('id'),'v_enfoques')==true){?>
<li class="nav-item start <?php if ($this->uri->segment(1)== "Focus"){?>active open<?php }?>">
    <a href="<?= base_url('Focus') ?>" class="nav-link nav-toggle" title="Cursos/Ciclos">
        <i class="fa fa-tripadvisor"></i>
        <span class="title">ENFOQUES PEDAGOGICOS</span>
        <span class="arrow"></span>
    </a>
</li>
<?php }?>
<?php if($this->Logueo->permisosUsuario($this->session->userdata('id'),'v_learning_u')==true){?>
<li class="nav-item start <?php if ($this->uri->segment(1)== "Learning_units"){?>active open<?php }?>">
    <a href="<?= base_url('Learning_units') ?>" class="nav-link nav-toggle" title="unidades de aprendizaje">
        <i class="fa fa-graduation-cap"></i>
        <span class="title">UNIDADES DE APRENDIZAJE</span>
        <span class="arrow"></span>
    </a>
</li>
<?php }?>
<?php if($this->Logueo->permisosUsuario($this->session->userdata('id'),'v_subject')==true){?>
<li class="nav-item start <?php if ($this->uri->segment(1)== "Subjects"){?>active open<?php }?>">
    <a href="<?= base_url('Subjects') ?>" class="nav-link nav-toggle" title="Asignaturas">
        <i class="fa fa-tasks"></i>
        <span class="title">ASIGNATURAS</span>
        <span class="arrow"></span>
    </a>
</li>
<?php }?>
<!--end menus modulo ciclos -->
