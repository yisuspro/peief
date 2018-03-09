<!--contenido pagina-->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <?php require_once 'heads/alertas.php'; ?>
        <h1 class="page-title">ASIGNATURAS
            <small>Lista de asignaturas</small>
        </h1>
        <?php require_once 'heads/barra_url.php'; ?>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="contentAjax">
                <!-- _________________________________________________________________espacio de trabajo ______________________________________________________________________________________ -->
                <div class="col-md-12">
                    <!-- Modal -->
                    <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header modal-header-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR ASIGNATURA</h1>
                                </div>

                                <div class="modal-body">
                                    <?= validation_errors(); ?>
                                    <?= form_open('','id="frm_agregar_asignatura"');?>
                                        <div class="form-wizard">
                                            <div class="form-group"><label>Nombre asignatura</label>
                                                <div class="input-group" id="SBJC_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="text" id="SBJC_name" name="SBJC_name" class="form-control" placeholder="Nombre" >
                                                </div>
                                                <div class="alert alert-danger invalid-feedback" id="SBJC_name_alerta" role="alert" style="display:none">
                                                    <div class="invalid-feedback">
                                                        <?= form_error('SBJC_name') ?>
                                                    </div>
                                                </div>
                                                <label>Descripcion</label>
                                                <div class="input-group" id="SBJC_description"><span class="input-group-addon"><i class="fa fa-book"></i></span>
                                                    <textarea type="text" id="SBJC_description" name="SBJC_description" class="form-control" placeholder="Descripcion" rows="3"></textarea>
                                                </div>
                                                <div class="alert alert-danger invalid-feedback" id="SBJC_description_alerta" role="alert" style="display:none">
                                                    <div class="invalid-feedback">
                                                        <?= form_error ('SBJC_description') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label> Unidad de aprendizaje</label>
                                            <select class="form-control" name="SBJC_FK_learning_units" id="SBJC_FK_learning_units">
                                                <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                                <option value="">Seleccione una unidad...</option>
                                                <?php foreach($unidades->result_array() as $r) { ?>
                                                <option value="<?= $r['LNUT_PK'];?>"><?= $r['LNUT_name']; ?></option>
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
                    <div class="portlet light portlet-fit  calendar">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-tasks font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">ASIGNATURAS</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="col-md-12">
                                <div class="actions">
                                    <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar una unidad de aprendiz"><i class="fa fa-plus"></i> Agregar</a>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Asignaturas</th>
                                        <th>Descripcion</th>
                                        <th>Unidad de aprendizaje</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Asignaturas</th>
                                        <th>Descripcion</th>
                                        <th>Unidad de aprendizaje</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
                <!-- ___________________________________________________fin espacio de trabajo____________________________________________________________________ -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!--fin del contenido de lapagina-->
<!--contenido pies de pagina-->

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
                [5, 10, 25, 50, "Todo"]
            ],
            "ajax": {
                url: "<?= base_url(); ?>Subjects/listarAsignaturas",
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
            columns: [{data:'SBJC_name'},
                      {data:'SBJC_description'},
                      {data:'LNUT_name'},
                      {mRender: function (data, type, row) {
                          return '<input type="button" class="btn btn-warning fa fa-remove edit" title="Editar unidad" value="editar" ><input type="button" class="btn btn-danger fa fa-remove remove" title="Eliminar unidad" value="eliminar" >';
                }
                }],
            pageLength: 10,
        });

        dt.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            eliminar = confirm("Seguro desea eliminar la unidad " + O.SBJC_name);
            if (eliminar) {
                $.ajax({
                    url: 'Subjects/eliminarAsignatura/' + O.SBJC_PK,
                    type: 'POST',
                    data: O.SBJC_PK,
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
                alert('No se ha eliminado el usuario')
            }
        });
        
        dt.on('click', '.edit', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            var url = 'Subjects/editarAsignatura/'+O.SBJC_PK;
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
            $("#frm_agregar_asignatura")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
        
        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_asignatura")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
        

        
        
        
        
});
</script>

<script src="<?= base_url()?>assets/js/subjects/agregar_asignaturas.js"></script>

