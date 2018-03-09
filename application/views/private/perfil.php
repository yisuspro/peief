<!--menu lateral fin-->
<!--contenido pagina-->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <h1 class="page-title"> PERFIL
            <small>pagina de perfil</small>
        </h1>
        <?php require_once 'heads/barra_url.php'; ?>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit  calendar">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-users font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">PERFIL</span>
                        </div>
                    </div>
                    <?php ?>
                    <div class="portlet-body">
                        <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
                        <div class="profile-userpic">
                            <img src="<?= base_url() ?>assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt="" width="100px" height="100px">
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR MENU -->
                        <div class="portlet-body">
                            <div class="mt-element-list">
                                <div class="mt-list-container list-default ext-1 group">
                                    <a class="list-toggle-container" data-toggle="collapse" href="#completed" aria-expanded="true">
                                        <div class="mt-list-title uppercase">
                                            INFORMACION PRINCIPAL
                                        </div>
                                    </a>
                                    <a class="list-toggle-container" data-toggle="collapse" href="#completed" aria-expanded="true">
                                        <div class="list-toggle done uppercase">
                                            INFORMACION BASICA
                                            <span class="badge badge-default pull-right bg-white font-green bold"></span>
                                        </div>
                                    </a>
                                    <div class="panel-collapse collapse in" id="completed">
                                        <ul>
                                            <li class="mt-list-item done">
                                                <div class="list-icon-container">
                                                    <i class="icon-user"></i>
                                                </div>
                                            

                                                <div class="list-item-content">
                                                    NOMBRE Y APELLIDOS
                                                    <p>
                                                        <?= $nombre; ?> <?= $this->session->userdata('apellido'); ?>
                                                        
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="mt-list-item done">
                                                <div class="list-icon-container">
                                                    <i class="fa fa-credit-card"></i>
                                                </div>
                                                
                                                <div class="list-item-content">
                                                    TIPO Y NUMERO DE DOCUMENTO
                                                    <p><?= $this->session->userdata('type_identification'); ?> : <?= $this->session->userdata('doc'); ?>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="mt-list-item done">
                                                <div class="list-icon-container">
                                                    <i class="fa fa-home"></i>
                                                </div>
                                                
                                                <div class="list-item-content">
                                                    DIRECCION DE RESIDENCIA
                                                    <p>
                                                        <?= $address;?>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="mt-list-item done">
                                                <div class="list-icon-container">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                
                                                <div class="list-item-content">
                                                    TELEFONO
                                                    <p>
                                                        <?= $telephone;?>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="mt-list-item done">
                                                <div class="list-icon-container">
                                                    <i class="fa fa-at"></i>
                                                </div>
                                                
                                                <div class="list-item-content">
                                                    CORREO ELECTRONICO
                                                    <p>
                                                        <?= $email;?>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="mt-list-item done">
                                                <div class="list-icon-container">
                                                    <i class="fa fa-venus-mars"></i>
                                                </div>

                                                <div class="list-item-content">
                                                    GENERO
                                                    <p>
                                                        <?= $gender; ?>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="mt-list-item done">
                                                <div class="list-icon-container">
                                                    <i class="fa fa-check-square-o"></i>
                                                </div>
                                               
                                                <div class="list-item-content">
                                                    ESTADO
                                                    <p>
                                                        <?= $state; ?>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="list-toggle-container" data-toggle="collapse" href="#documentacion" aria-expanded="false">
                                        <div class="list-toggle uppercase">
                                            DOCUMENTOS EXTRA
                                        </div>
                                    </a>
                                    <div class="panel-collapse collapse" id="documentacion">
                                        <ul>
                                            <li class="mt-list-item">
                                                <div class="list-icon-container">
                                                    <a href="javascript:;">
                                                                <i class="icon-close"></i>
                                                            </a>
                                                </div>
                                                <div class="list-datetime"> 11am
                                                    <br/> 8 Nov </div>
                                                <div class="list-item-content">
                                                    <h3 class="uppercase">
                                                        <a href="javascript:;">Listings Feature</a>
                                                    </h3>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="list-toggle-container" data-toggle="collapse" href="#padrino" aria-expanded="false">
                                        <div class="list-toggle uppercase">
                                            APADRINAMIENTO
                                        </div>
                                    </a>
                                    <div class="panel-collapse collapse" id="padrino">
                                        <ul>
                                            <li class="mt-list-item">
                                                <div class="list-icon-container">
                                                    <a href="javascript:;">
                                                                <i class="icon-close"></i>
                                                            </a>
                                                </div>
                                                <div class="list-datetime"> 11am
                                                    <br/> 8 Nov </div>
                                                <div class="list-item-content">
                                                    <h3 class="uppercase">
                                                        <a href="javascript:;">Listings Feature</a>
                                                    </h3>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- END MENU -->
                            
                            <!-- fin espacio de trabajo_______________________________________________________________________________________________________________________ -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
