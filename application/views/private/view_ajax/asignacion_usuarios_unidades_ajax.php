<div class="contentAjax">
    <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
    <div class="col-md-12">
        <div class="portlet light portlet-fit  calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-check-square font-yellow"></i>
                    <span class="caption-subject font-green sbold uppercase">USUARIOS ASIGNADOS</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="col-md-2">
                    <div class="actions">
                        <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar un usuario"><i class="fa fa-plus"></i>agregar</a>
                    </div>
                </div>

                <br><br><br>
                <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>

                <div class="actions">
                    <a id="atras" href="javascript:;" class="btn btn-simple btn-danger btn-icon create" title="Agregar un usuario"><i class="fa fa-reply"></i>atras</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR USUARIO</h1>
                </div>
                <div class="modal-body">
                    <?php echo validation_errors(); ?>
                    <?= form_open('Usuarios/registrar','id="frm_agregar_usuario"');?>
                        <div class="form-wizard">
                            <div class="form-group">
                                <div class="alert alert-danger invalid-feedback" id="alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        el usuario no existe o ya se encuentra en el grupo
                                    </div>
                                </div>
                                <input type="hidden" name="USLE_FK_learning_units" id="USLE_FK_learning_units" value="<?php echo $id ;?>">
                                       <label>Numero de Docuemnto</label>
                                <div class="input-group" id="USLE_FK_users"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="USLE_FK_users" name="USLE_FK_users" class="form-control" placeholder="Docueto">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="USLE_FK_users_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('USLE_FK_users') ?>
                                    </div>
                                </div>

                                <label>Rol</label>
                                <select class="form-control" name="USLE_FK_roles" id="USLE_FK_roles">
                                    <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                    <?php foreach($roles->result_array() as $r) { ?>
                                    <option value="<?php echo $r['ROLE_PK'];?>"><?php echo $r['ROLE_name']; ?></option>
                                    <?php }?>
                                </select>
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


    <!-- fin espacio de trabajo_______________________________________________________________________________________________________________________ -->
</div>

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
                url: "<?= base_url('Learning_units/listarUsuarios/'.$id); ?>",
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
            
            columns: [{data:'USER_names'},
                     {data:'ROLE_name'},
                {mRender: function (data, type, row) {
                    return '<input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar usuario" value="eliminar" >';
                }
                }],
            pageLength: 10,
        });

        dt.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            eliminar = confirm("Seguro desea quitar este usuario?  " + O.USER_names);
            if (eliminar) {
                $.ajax({
                    url: '<?= base_url() ?>Learning_units/eliminarUsuario/' + O.USLE_PK,
                    type: 'POST',
                    data: O.USLE_PK,
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
        $("#archivo3").on('click', function(e) {
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
        $("#atras").on('click', function(e) {
            e.preventDefault();
            var url = 'Learning_units';
            location.href = url;
        });
    });

</script>
<script src="<?= base_url('assets/js/learning_units/agregar_usuarios_learning_units.js')?>"></script>
