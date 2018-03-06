<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <?php require_once 'heads/alertas.php'; ?>
        <h1 class="page-title"> USUARIOS
            <small>Lista de usuarios</small>
        </h1>
        <?php require_once 'heads/barra_url.php'; ?>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="contentAjax">
                <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
                <div class="col-md-12">
                    <div class="portlet light portlet-fit  calendar">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-users font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">USUARIOS</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="col-md-12">
                                <div class="actions">
                                    <a id="create" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar un usuario"><i class="fa fa-plus"></i> Agregar</a>
                                </div>
                            </div>
                            <br><br><br>
                            <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>correo</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>


                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Correos</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>


                                    </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        
                        <!--Modal Agregar Usuario -->
                        <div class="col-md-12">
                                <!-- Modal -->
                                <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header modal-header-success">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR USUARIO</h1>
                                            </div>
                                            <div class="form-group" id="alerta" style="display:none">
                                                <div class="alert alert-danger" role="alert">
                                                    El usuario ya existe porfavor comprobar los datos
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo validation_errors(); ?>
                                                <?= form_open('Usuarios/registrar','id="frm_agregar_usuario"');?>
                                                    <div class="form-wizard">
                                                        <div class="form-group">
                                                            <div class="alert alert-danger" id="USER_identification_alerta" role="alert" style="display:none">
                                                                <div class="invalid-feedback">
                                                                    <?php echo form_error ('USER_identification') ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Documento</label>

                                                                <div class="input-group" id="USER_identification">
                                                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                                    <input type="text" id="USER_identification" name="USER_identification" class="form-control is-invalid" placeholder="Documento de identidad">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label> Tipo de Documento</label>
                                                                <select class="form-control" name="USER_FK_type_identification" id="USER_FK_type_identification">
                                                                <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                                                <option value="1">C.C.</option>
                                                                <option value="2">T.I.</option>
                                                                <option value="3">Registro</option>
                                                                <option value="4">pasaporte</option>
                                                                <option value="5">Option 5</option>
                                                            </select>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <br>

                                                            <label>Nombres</label>
                                                            <div class="input-group" id="USER_names"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                <input type="text" id="USER_names" name="USER_names" class="form-control" placeholder="Nombres">
                                                            </div>
                                                            <div class="alert alert-danger invalid-feedback" id="USER_names_alerta" role="alert" style="display:none">
                                                                <div class="invalid-feedback">
                                                                    <?php echo form_error('USER_names') ?>
                                                                </div>
                                                            </div>


                                                            <label>Apellidos</label>
                                                            <div class="input-group" id="USER_lastnames"><span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                                <input type="text" id="USER_lastnames" name="USER_lastnames" class="form-control" placeholder="Apellidos">
                                                            </div>
                                                            <div class="alert alert-danger invalid-feedback" id="USER_lastnames_alerta" role="alert" style="display:none">
                                                                <div class="invalid-feedback">
                                                                    <?= form_error ('USER_lastnames') ?>
                                                                </div>
                                                            </div>

                                                            <label>Correo</label>
                                                            <div class="input-group" id="USER_email"><span class="input-group-addon"><i class="fa fa-at"></i></span>
                                                                <input type="email" id="USER_email" name="USER_email" class="form-control" placeholder="Correo">
                                                            </div>
                                                            <div class="alert alert-danger invalid-feedback" id="USER_email_alerta" role="alert" style="display:none">
                                                                <div class="invalid-feedback">
                                                                    <?= form_error ('USER_email') ?>
                                                                </div>
                                                            </div>

                                                            <label>Direccion</label>
                                                            <div class="input-group" id="USER_address"><span class="input-group-addon"><i class="fa fa-industry"></i></span>
                                                                <input type="text" id="USER_address" name="USER_address" class="form-control" placeholder="Direccion">
                                                            </div>
                                                            <div class="alert alert-danger invalid-feedback" id="USER_address_alerta" role="alert" style="display:none">
                                                                <div class="invalid-feedback">
                                                                    <?= form_error ('USER_address') ?>
                                                                </div>
                                                            </div>



                                                            <label>Telefono</label>
                                                            <div class="input-group" id="USER_telephone"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                <input type="text" id="USER_telephone" name="USER_telephone" class="form-control" placeholder="Telefono">
                                                            </div>
                                                            <div class="alert alert-danger invalid-feedback" id="USER_telephone_alerta" role="alert" style="display:none">
                                                                <div class="invalid-feedback">
                                                                    <?= form_error ('USER_telephone') ?>
                                                                </div>
                                                            </div>

                                                            <label>Contraseña</label>
                                                            <div class="input-group" id="USER_password"><span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                                                <input type="password" id="USER_password" name="USER_password" class="form-control" placeholder="Contraseña">
                                                            </div>
                                                            <div class="alert alert-danger invalid-feedback" id="USER_password_alerta" role="alert" style="display:none">
                                                                <div class="invalid-feedback">
                                                                    <?= form_error ('USER_password') ?>
                                                                </div>
                                                            </div>

                                                            <label> Genero</label>
                                                            <div class="input-group" name="USER_FK_gander" id="USER_FK_gender"><span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                                                                <select class="form-control" id="USER_FK_gander" name="USER_FK_gander">
                                                                <option value="1">Masculino</option>
                                                                <option value="2">Femenino</option>
                                                                <option value="3">Otro</option>
                                                            </select>
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
                            </div>
                        
                    
                        
                    </div>
                </div>
                <!-- fin espacio de trabajo_______________________________________________________________________________________________________________________ -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<?php require_once 'footers/foot_3.php';?>
<script>
    $(document).ready(function() {
        var dt;
        dt = $('#sample_1');
        dt.DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todo"]
            ],
            "ajax": {
                url: "<?php echo base_url(); ?>Usuarios/listarTabla",
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
            columns: [{data:'USER_identification'},
                     {data:'USER_names'},
                     {data:'USER_lastnames'},
                     {data:'USER_email'},
                     {data:'USER_telephone'},
                     {data:'USER_address'},
                     {data:'STTS_state'},
                {mRender: function (data, type, row) {
                    return '<input type="button" class="btn btn-warning fa fa-remove edit" title="Editar un usuario"  value="editar" ><input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar un usuario" value="eliminar" ><input type="button" class="btn btn-info fa fa-remove asignar" title="Asignar un rol"  value="asignar" >';
                }
                }],
            pageLength: 10,
        });

        dt.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            eliminar = confirm("Seguro desea eliminar el usuario " + O.USER_names +"  "+O.USER_lastnames);
            if (eliminar) {
                $.ajax({
                    url: 'eliminarUsuario/' + O.USER_PK,
                    type: 'POST',
                    data: O.USER_PK,
                    success: function(data, xhr) {
                        $("#sample_1").DataTable().ajax.reload();
                        document.getElementById('alerta_principal').style.display = 'inherit';
                    },
                    error: function(xhr) {
                        alert('Ocurrio algo inesperado por lo cual no se pudo eliminar el usuario')
                        $("#sample_1").DataTable().ajax.reload();
                    },

                });
            } else {
                alert('No se ha eliminado el usuario')
            }

        });        
        
        dt.on('click', '.edit', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = dt.DataTable().row($tr).data();
				$.ajax({
					type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function (data) {
					route = 'editarUsuario/'+O.USER_PK;
					$(".contentAjax").load(route);
                });
            });
        
        
        
        
        dt.on('click', '.asignar', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = dt.DataTable().row($tr).data();
                $.ajax({
                    type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function (data) {
                    route = 'asignarRol/'+O.USER_PK;
					$(".contentAjax").load(route);
                });
            });

        $("#create").on('click', function(e) {
            e.preventDefault();
            $('#agregar').removeClass('fade');
            $('#agregar').addClass('fade-in');
            document.getElementById('agregar').style.display = 'inherit';
        });
        

        
        
        
        $(".close").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_usuario")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_usuario")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
});
</script>

<script src="<?= base_url('assets/js/usuarios/agregar_usuarios.js')?>"></script>

