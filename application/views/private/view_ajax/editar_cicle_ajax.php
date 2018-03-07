<div class="row">
    <div class="containerAjax">
        <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
        <div class="col-md-12">
            <div class="portlet light portlet-fit  calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-map font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">EDITAR CURSO</span>
                    </div>
                </div>
                <div class="portlet-body">

                    <a class="btn btn-danger" type="button" href="#" id="atras" name="atras"><i class="fa fa-mail-reply"></i>atras</a>
                    <?= form_open('','id="frm_editar_cicle"');?>
                        <div class="form-wizard">
                            <div class="form-group">
                                <input type="hidden" id="CCLS_PK_hidden" value="<?php echo $CCLS_PK; ?>">
                                <label>Nombre</label>
                                <div class="input-group" id="CCLS_name"><span class="input-group-addon"><i class="fa fa-map"></i></span>
                                    <input type="text" id="CCLS_name" name="CCLS_name" class="form-control" placeholder="Nombre" value="<?php echo $CCLS_name; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="CCLS_name_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('CCLS_name') ?>
                                    </div>
                                </div>
                                <label> Tipo de version y plan</label>
                                <select class="form-control" name="CCLS_FK_versions_plans" id="CCLS_FK_versions_plans">
                                    <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                    <option value="<?php echo $CCLS_FK_versions_plans;?>"><?php echo $VRSN_name.'/'.$PLAN_name; ?></option>
                                    <?php foreach($versiones->result_array() as $r) { ?>
                                    <option value="<?php echo $r['VRPL_PK'];?>"><?php echo $r['VRSN_name'].'/'.$r['PLAN_name']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="modal-footer">
                                        <?= form_submit('agregar', 'Editar','class="btn btn-success"') ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= form_close();?>
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
                        <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR UN CURSO</h1>
                    </div>
                    <div class="modal-body">
                        <?php echo validation_errors(); ?>
                        <?= form_open('Usuarios/registrar','id="frm_agregar_miembro"');?>
                            <div class="form-wizard">
                                <div class="form-group">

                                    <input type="hidden" name='CICLE_PK' id="CICLE_PK" value="<?php echo $CCLS_PK; ?>">
                                    <div class="alert alert-danger invalid-feedback" id="alerta" role="alert" style="display:none">
                                        <div class="invalid-feedback">
                                            el usuario no existe o ya se encuentra en el grupo
                                        </div>
                                    </div>
                                    <label>Numero de Docuemnto</label>
                                    <div class="input-group" id="UMCL_FK_users"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" id="UMCL_FK_users" name="UMCL_FK_users" class="form-control" placeholder="Nombre">
                                    </div>
                                    <div class="alert alert-danger invalid-feedback" id="UMCL_FK_users_alerta" role="alert" style="display:none">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('UMCL_FK_users') ?>
                                        </div>
                                    </div>

                                    <label>Rol</label>
                                    <select class="form-control" name="UMCL_FK_roles" id="UMCL_FK_roles">
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

        <div class="col-md-12">
            <div class="portlet light portlet-fit  calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-group font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">MIEMBROS</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-12">
                        <div class="actions">
                            <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar un miembro a un curso"><i class="fa fa-plus"></i>Agregar</a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre y Apellidos</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre y Apellidos</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- fin espacio de trabajo_______________________________________________________________________________________________________________________ -->
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $("#frm_editar_cicle").submit(function(event) {
            event.preventDefault();
            var tr = $('#CCLS_PK_hidden').val();
            eliminar = confirm("Seguro desea actualizar el plan " + tr);
            if (eliminar) {
                $.ajax({
                    async: false,
                    url: 'Cicles/modificarCicle/' + tr,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data, xhr) {
                        document.getElementById('CCLS_name_alerta').style.display = 'none';
                        document.getElementById('alerta_principal').style.display = 'inherit';
                    },
                    error: function(xhr) {
                        document.getElementById('CCLS_name_alerta').style.display = 'none';
                        if (xhr.status == 402) {
                            var json = JSON.parse(xhr.responseText);
                            if (json.CCLS_name.length != 0) {
                                $("#CCLS_name_alerta > div").html(json.CCLS_name);
                                document.getElementById('CCLS_name_alerta').style.display = 'inherit';
                            }

                        } else if (xhr.status == 401) {
                            document.getElementById('alerta').style.display = 'inherit';
                        }
                    },

                });
            } else {
                alert('No se ha modificado el Plan')
            }
        });

        $("#atras").on('click', function(e) {
            e.preventDefault();
            var url = 'Cicles';
            location.href = url;
        });
        $("#archivo3").on('click', function(e) {
            e.preventDefault();
            $('#agregar').removeClass('fade');
            $('#agregar').addClass('fade-in');
            document.getElementById('agregar').style.display = 'inherit';
        });
        $(".close").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_miembro")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            $("#frm_agregar_miembro")[0].reset();
            $('#agregar').removeClass('fade-in');
            $('#agregar').addClass('fade');
            document.getElementById('agregar').style.display = 'none';
        });
    });

</script>

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
                url: "<?= base_url('Cicles/listarMiembrosCicles/'); ?><?php echo $CCLS_PK; ?>",
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
                    url: 'Cicles/eliminarMiembro/' + tr,
                    type: 'POST',
                    data: tr,
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
    });

</script>
<script src="<?= base_url('assets/js/cicles/agregar_miembro_cicle.js')?>">
</script>
