<!--titulo de la pagina-->
<?php require_once 'heads/head_1.php'; ?> Perfil
<?php require_once 'heads/head_2.php'; ?>
<!--titulo de la pagina fin-->
<!--librerias extras-->

<!--librerias extras fin-->
<!--cabeza de pagina-->
<?php require_once 'heads/head_3.php'; ?>
<!--fin de cabeza-->

<!--menu lateral-->
<?php require_once 'heads/menus.php'; ?>
<!--menu lateral fin-->

<!--contenido pagina-->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- tool de configuracion -->
        <h1 class="page-title"> PERFIL DE USUARIO
            <small>PERFIL</small>
        </h1>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index.html">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>USUARIO</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#">
                                <i class="icon-bell"></i>
                                Action
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- fin tool de configuracion -->
        <!-- espacio de trabajo -->

        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">perfil</span>
                    <span class="caption-helper hide">perfil</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-unstyled profile-nav">
                        <li>
                            <img src="<?= base_url('assets/pages/media/profile/people19.png')?>" class="img-responsive pic-bordered" alt="" />

                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <!-- fin espacio de trabajo -->
    </div>
</div>
<!--fin del contenido de lapagina-->
<!--contenido pies de pagina-->
<?php require_once 'footers/foot_1.php';?>
<!-- fin contenido pies de pagina-->

<!--aqui se pueden agregar ls scrips necesarios  que nesesite la pagina-->







<!--fin scrips-->

<!--scrips pie de pagina-->
<?php require_once 'footers/foot_2.php';?>
<!--fin scrips pie de pagina-->
