<!--titulo de la pagina-->
<?php require_once 'heads/head_1.php'; ?> Unidades de aprendizaje
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
        <h1 class="page-title"> UNIDADES DE APRENDIZAJE
            <small>Lista de unidades de aprendizaje</small>
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
                                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR UNIDAD</h1>
                                </div>

                                <div class="modal-body">
                                    <?php echo validation_errors(); ?>
                                    <?= form_open('','id="frm_agregar_unidad"');?>
                                        <div class="form-wizard">
                                            <div class="form-group"><label>Nombre unidad</label>
                                                <div class="input-group" id="LNUT_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="text" id="LNUT_name" name="LNUT_name" class="form-control" placeholder="Nombre" >
                                                </div>
                                                <div class="alert alert-danger invalid-feedback" id="LNUT_name_alerta" role="alert" style="display:none">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('LNUT_name') ?>
                                                    </div>
                                                </div>
                                                <label>Descripcion</label>
                                                <div class="input-group" id="LNUT_description"><span class="input-group-addon"><i class="fa fa-book"></i></span>
                                                    <input type="text" id="LNUT_description" name="LNUT_description" class="form-control" placeholder="Direccion" >
                                                </div>
                                                <div class="alert alert-danger invalid-feedback" id="LNUT_description_alerta" role="alert" style="display:none">
                                                    <div class="invalid-feedback">
                                                        <?= form_error ('LNUT_description') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <label> Tipo de enfoque pedagogico</label>
                                            <select class="form-control" name="LNUT_FK_focus" id="LNUT_FK_focus">
                                                <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                                <?php foreach($focus->result_array() as $r) { ?>
                                                <option value="<?php echo $r['FOCS_PK'];?>"><?php echo $r['FOCS_name']; ?></option>
                                                <?php }?>
                                            </select>

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="modal-footer">
                                                        <?= form_submit('agregar', 'Editar','class="btn btn-success"') ?>
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
                                <i class="fa fa-language font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">UNIDADES DE APRENDIZAJE</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="col-md-12">
                                <div class="actions">
                                    <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar una unidad de aprendizaje"><i class="fa fa-plus"></i> Agregar</a>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Unidad</th>
                                        <th>Descripcion</th>
                                        <th>Enfoque pedagogico</th>
                                        <th>Acciones</th>


                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Unidad</th>
                                        <th>Descripcion</th>
                                        <th>Enfoque pedagogico</th>
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
                [5, 10, 25, 50, "Todo"]
            ],
            "ajax": {
                url: "<?= base_url('index.php/Learning_units/listarUnidades'); ?>",
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
            eliminar = confirm("Seguro desea eliminar la unidad " + tr);
            if (eliminar) {
                $.ajax({
                    url: 'Learning_units/eliminarUnidades/' + tr,
                    type: 'POST',
                    data: tr,
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
            var tr = this.id;
            var url = 'Learning_units/editarUnidades/'+tr;
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
            $("#frm_agregar_unidad")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
        
        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_unidad")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
});
</script>

<script src="<?= base_url('assets/js/learning_units/agregar_learning_units.js')?>"></script>

<!--fin scrips-->

<!--scrips pie de pagina-->
<?php require_once 'footers/foot_2.php';?>
<!--fin scrips pie de pagina-->
