<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <?php require_once 'heads/alertas.php'; ?>
        <h1 class="page-title"> CURSOS
            <small>Lista de cursos</small>
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
                                <i class="fa fa-cubes font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">CURSOS</span>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header modal-header-success">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                        <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR UN CURSO</h1>
                                    </div>
                                    <div class="modal-body">
                                        <?= validation_errors(); ?>
                                        <?= form_open('Usuarios/registrar','id="frm_agregar_cicle"');?>
                                            <div class="form-wizard">
                                                <div class="form-group">
                                                    <label>Nombre del curso</label>
                                                    <div class="input-group" id="CCLS_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                        <input type="text" id="CCLS_name" name="CCLS_name" class="form-control" placeholder="Nombre">
                                                    </div>
                                                    <div class="alert alert-danger invalid-feedback" id="CCLS_name_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?= form_error('CCLS_name') ?>
                                                        </div>
                                                    </div>
                                                    <label> Tipo de version y plan</label>
                                                    <select class="form-control" name="CCLS_FK_plans" id="CCLS_FK_plans">
                                                        <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                                        <?php foreach($versiones->result_array() as $r) { ?>
                                                        <option value="<?= $r['PLAN_PK'];?>"><?= $r['PLAN_name']; ?></option>
                                                        <?php }?>
                                                    </select>


                                                    <div class="alert alert-danger invalid-feedback" id="PLAN_description_alerta" role="alert" style="display:none">
                                                        <div class="invalid-feedback">
                                                            <?= form_error ('PLAN_description') ?>
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
                                <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar un curso"><i class="fa fa-plus"></i> Agregar</a>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="portlet-body">
                            <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Version/Plan</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Version/Plan</th>
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
                url: "<?= base_url(); ?>Cicles/listarCicles",
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
            
             columns: [{data:'CCLS_name'},
                      {data:'PLAN_name'},
                {mRender: function (data, type, row) {
                    return '<input type="button" class="btn btn-warning edit" title="Editar Curso" value="editar" ><input type="button" class="btn btn-danger remove" title="Eliminar Curso" value="eliminar" ><input type="button" class="btn btn-success asignar" title="Agregar asignaturas"  value="asignaturas" >';
                }
                }],  
            
    
            
            pageLength: 10,
        });

        dt.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');             
            var O = dt.DataTable().row($tr).data();
            eliminar = confirm("Seguro desea eliminar el ciclo" + O.CCLS_name);
            if (eliminar) {
                $.ajax({
                    url: 'Cicles/eliminarCicles/' + O.CCLS_PK,
                    type: 'POST',
                    data: O.CCLS_PK,
                    success: function(data, xhr) {
                        $("#sample_1").DataTable().ajax.reload();
                        document.getElementById('alerta_principal').style.display = 'inherit';
                    },
                    error: function(xhr) {
                        alert('el curso contiene miembros o asignaturas por lo cual no se pede eliminar')
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
            var url = 'Cicles/editarCicle/' + O.CCLS_PK;
            $(".contentAjax").load(url);
        });
        dt.on('click', '.asignar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');             
            var O = dt.DataTable().row($tr).data();
            var url = 'Cicles/asignarMateria/' + O.CCLS_PK;
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
            $("#frm_agregar_cicle")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_cicle")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
    });

</script>
<script src="<?= base_url()?>assets/js/cicles/agregar_cicles.js"></script>
<!--fin scrips-->
