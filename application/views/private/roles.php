<!--titulo de la pagina-->
<?php require_once 'heads/head_1.php'; ?> roles usuarios
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
        <!-- BEGIN PAGE HEADER-->
        <?php require_once 'heads/alertas.php'; ?>
        <h1 class="page-title"> ROLES
            <small>Lista de roles</small>
        </h1>
        <?php require_once 'heads/barra_url.php'; ?>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="contentAjax">
                <!--_________________________________________________espacio de trabajo______________________________________________________________________________________________________-->
                
                <div class="col-md-12">
                    <div class="portlet light portlet-fit  calendar">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-group font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">ROLES</span>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header modal-header-success">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                        <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR ROL</h1>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <?php echo validation_errors(); ?>
                                        <?= form_open('Usuarios/registrar','id="frm_agregar_rol"');?>
                                            <div class="form-wizard">
                                                <div class="form-group">
                                                    <div class="alert alert-danger" id="ROLE_PK_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?php echo form_error ('ROLE_PK') ?>
                                                        </div>
                                                    </div>

                                                    <label>Nombre</label>
                                                    <div class="input-group" id="ROLE_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                        <input type="text" id="ROLE_name" name="ROLE_name" class="form-control" placeholder="Nombre">
                                                    </div>
                                                    <div class="alert alert-danger invalid-feedback" id="ROLE_name_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?php echo form_error('ROLE_name') ?>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <label>Nombre Corto</label>
                                                    <div class="input-group" id="ROLE_shortname"><span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                        <input type="text" id="ROLE_shortname" name="ROLE_shortname" class="form-control" placeholder="Nombre corto">
                                                    </div>
                                                    <div class="alert alert-danger invalid-feedback" id="ROLE_shortname_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?= form_error ('ROLE_shortname') ?>
                                                        </div>
                                                    </div>
                                                    
                                                    

                                                    <label>Descripcion</label>
                                                    <div class="input-group" id="ROLE_description"><span class="input-group-addon"><i class="fa fa-book"></i></span>
                                                        <input type="text" id="ROLE_description" name="ROLE_description" class="form-control" placeholder="Dscripcion">
                                                    </div>
                                                    <div class="alert alert-danger invalid-feedback" id="ROLE_description_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?= form_error ('ROLE_description') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="modal-footer">
                                                            <?= form_submit('agregar', 'Agregar','class="btn btn-success"') ?>
                                                                <a class="btn btn-danger" type="button" href="#" id="cerrar" name="cerrar">Cancelar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                        <div class="col-md-12">
                            <div class="actions">
                                <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar un rol"><i class="fa fa-plus"></i> Agregar</a>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="portlet-body">
                            <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Rol</th>
                                        <th>Nombre corto</th>
                                        <th>Descripcion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Rol</th>
                                        <th>Nombre corto</th>
                                        <th>Descripcion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ________________________________________________________________fin espacio de trabajo_______________________________________________________ -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!--fin del contenido de lapagina-->
<!--contenido pies de pagina-->
<?php require_once 'footers/foot_1.php';?>
<?php require_once 'footers/foot_3.php';?>
<!-- fin contenido pies de pagina-->
<!--aqui se pueden agregar ls scrips necesarios  que nesesite la pagina-->
<script>
    $(document).ready(function() {
        var dt;
        dt = $('#sample_1');
        dt.DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todo"],
            ],
            "ajax": {
                url: "<?php echo base_url('index.php/Roles/listarRoles'); ?>",
                type: 'GET'
            },
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-print',
                    text: '<i class="fa fa-print"></i>'
                },
                {
                    extend: 'copy',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy',
                    text: '<i class="fa fa-files-o"></i>'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel',
                    text: '<i class="fa fa-file-excel-o"></i>',
                },
                {
                    extend: 'csv',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',
                    text: '<i class="fa fa-file-text-o"></i>',
                },

            ],
            pageLength: 10,
        });

        dt.on('click', '.remove', function(e) {
            var tr = this.id;
            eliminar = confirm("Seguro desea eliminar el rol" + tr);
            if (eliminar) {
                $.ajax({
                    url: 'Roles/eliminarRoles/' + tr,
                    type: 'POST',
                    data: tr,
                    success: function(data, xhr) {
                        $("#sample_1").DataTable().ajax.reload();
                        document.getElementById('alerta_principal').style.display = 'inherit';
                    },
                    error: function(xhr) {
                        alert('ocurrio algo inesperado por lo cual no se pudo eliminar el usuario')
                        $("#sample_1").DataTable().ajax.reload();
                    },

                });
            } else {
                alert('No se ha eliminado el usuario')
            }

        });
        dt.on('click', '.edit', function(e) {
            e.preventDefault();
            var tr = this.id;
            var url = 'Roles/editarRol/' + tr;
            $(".contentAjax").load(url);
        });
        dt.on('click', '.asignar', function(e) {
            e.preventDefault();
            var tr = this.id;
            var url = 'Roles/asignarPermiso/' + tr;
            $(".contentAjax").load(url);
        });

        $("#archivo3").on('click', function(e) {
            e.preventDefault();
            $('#agregar').removeClass('fade');
            $('#agregar').addClass('fade-in');
            document.getElementById('agregar').style.display = 'inherit';
        });
        $(".close").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_rol")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_rol")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
    });

</script>
<script src="<?= base_url('assets/js/roles/agregar_roles.js')?>"></script>
<!--fin scrips-->
<!--scrips pie de pagina-->
<?php require_once 'footers/foot_2.php';?>
<!--fin scrips pie de pagina-->
