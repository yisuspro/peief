
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <?php require_once 'heads/alertas.php'; ?>
        <h1 class="page-title"> PERMISOS
            <small>Lista de Permisos</small>
        </h1>
        <?php require_once 'heads/barra_url.php'; ?>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="contentAjax">
                <!-- WORK SPACE-->
                <div class="col-md-12">
                    
                    <div class="portlet light portlet-fit  calendar">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-language font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">PERMISOS</span>
                            </div>
                        </div>
                        
                        <div class="portlet-body">
                            <div class="col-md-12">
                            <div class="actions">
                                <a id="create" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar un permiso"><i class="fa fa-plus"></i> Agregar</a>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                            <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Permiso</th>
                                        <th>Nombre corto</th>
                                        <th>Descripcion</th>
                                        <th>Acciones</th>


                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Permiso</th>
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
                    <!-- MODAL ADD PERMMISION -->
                        <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header modal-header-success">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                        <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR PERMISO</h1>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <?php echo validation_errors(); ?>
                                        <?= form_open('Usuarios/registrar','id="frm_agregar_permiso"');?>
                                            <div class="form-wizard">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <div class="input-group" id="PRMS_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                        <input type="text" id="PRMS_name" name="PRMS_name" class="form-control" placeholder="Nombre">
                                                    </div>
                                                    <div class="alert alert-danger invalid-feedback" id="PRMS_name_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?php echo form_error('PRMS_name') ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <label>Nombre Corto</label>
                                                    <div class="input-group" id="PRMS_shortname"><span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                        <input type="text" id="PRMS_shortname" name="PRMS_shortname" class="form-control" placeholder="Nombre corto">
                                                    </div>
                                                    <div class="alert alert-danger invalid-feedback" id="PRMS_shortname_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?= form_error ('PRMS_shortname') ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <label>Descripcion</label>
                                                    <div class="input-group" id="PRMS_description"><span class="input-group-addon"><i class="fa fa-book"></i></span>
                                                        <input type="text" id="PRMS_description" name="PRMS_description" class="form-control" placeholder="Descripcion">
                                                    </div>
                                                    <div class="alert alert-danger invalid-feedback" id="PRMS_description_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?= form_error ('PRMS_description') ?>
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
            </div>
                
                <!--END WORK SPACE-->
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
                url: "<?= base_url(); ?>Permisos/listarPermisos",
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
            columns: [{data:'PRMS_name'},
                      {data:'PRMS_shortname'},
                      {data:'PRMS_description'},
                {mRender: function (data, type, row) {
                    return '<input type="button" class="btn btn-warning fa fa-remove edit" title="Editar permiso"  value="editar" ><input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar permiso"  value="eliminar" >';
                }
                }],  
            pageLength: 10,
        });

        dt.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            eliminar = confirm("Seguro desea eliminar el permiso " + O.PRMS_name);
            if (eliminar) {
                $.ajax({
                    url: 'Permisos/eliminarPermisos/' + O.PRMS_PK,
                    type: 'POST',
                    data: O.PRMS_PK,
                    success: function(data, xhr) {
                        $("#sample_1").DataTable().ajax.reload();
                        document.getElementById('alerta_principal').style.display = 'inherit';
                    },
                    error: function(xhr) {
                        alert('otro usuario tiene este permiso por lo cual no se puede eliminar')
                        $("#sample_1").DataTable().ajax.reload();
                    },
                });
            } else {
                alert('No se ha eliminado el permiso')
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
					route = 'Permisos/editarPermisos/'+O.PRMS_PK;
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
            $("#frm_agregar_permiso")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
        
        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_permiso")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
});
</script>

<script src="<?= base_url('assets/js/permisos/agregar_permisos.js')?>"></script>
