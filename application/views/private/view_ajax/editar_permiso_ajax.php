<div class="row">
    <div class="containerAjax">

        <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
        <div class="col-md-12">
            <div class="portlet light portlet-fit  calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-users font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">EDITAR ROL</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= form_open('','id="frm_editar_rol"');?>
                        <div class="form-wizard">
                            <div class="form-group">
                                <div class="alert alert-danger" id="PRMS_PK_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('PRMS_PK') ?>
                                    </div>
                                </div>
                                <input type="hidden" id="PRMS_PK_hidden" value="<?= $PRMS_PK; ?>">


                                <label>Nombre</label>
                                <div class="input-group" id="PRMS_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="PRMS_name" name="PRMS_name" class="form-control" placeholder="Nombre" value="<?= $PRMS_name; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="PRMS_name_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error('PRMS_name') ?>
                                    </div>
                                </div>


                                <label>Nombre corto</label>
                                <div class="input-group" id="PRMS_shortname"><span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    <input type="text" id="PRMS_shortname" name="PRMS_shortname" class="form-control" placeholder="Apellidos" value="<?= $PRMS_shortname; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="PRMS_shortname_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('PRMS_shortname') ?>
                                    </div>
                                </div>


                                <label>Descripcion</label>
                                <div class="input-group" id="PRMS_description"><span class="input-group-addon"><i class="fa fa-book"></i></span>
                                    <input type="text" id="PRMS_description" name="PRMS_description" class="form-control" placeholder="Direccion" value="<?= $PRMS_description; ?>">
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
                                        <?= form_submit('agregar', 'Editar','class="btn btn-success"') ?>
                                            <a class="btn btn-danger" type="button" href="#" id="atras" name="atras">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= form_close();?>
                </div>
            </div>
        </div>
        <!-- fin espacio de trabajo_______________________________________________________________________________________________________________________ -->

    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $("#frm_editar_rol").submit(function(event) {
            event.preventDefault();
            var tr = $('#PRMS_PK_hidden').val();
            eliminar = confirm("Seguro desea actualizar el rol " + tr);
            if (eliminar) {
                $.ajax({
                    async: false,
                    url: 'Permisos/modificarPermisos/' + tr,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data, xhr) {
                        document.getElementById('PRMS_name_alerta').style.display = 'none';
                        document.getElementById('PRMS_shortname_alerta').style.display = 'none';
                        document.getElementById('PRMS_description_alerta').style.display = 'none';
                        location.href = "Permisos";

                    },
                    error: function(xhr) {
                        document.getElementById('PRMS_name_alerta').style.display = 'none';
                        document.getElementById('PRMS_shortname_alerta').style.display = 'none';
                        document.getElementById('PRMS_description_alerta').style.display = 'none';
                        if (xhr.status == 402) {
                            var json = JSON.parse(xhr.responseText);
                            
                            if (json.PRMS_name.length != 0) {
                                $("#PRMS_name_alerta > div").html(json.PRMS_name);
                                document.getElementById('PRMS_name_alerta').style.display = 'inherit';
                            }
                            if (json.PRMS_shortname.length != 0) {
                                $("#PRMS_shortname_alerta > div").html(json.PRMS_shortname);
                                document.getElementById('PRMS_shortname_alerta').style.display = 'inherit';
                            }
                            if (json.PRMS_description.length != 0) {
                                $("#PRMS_description_alerta > div").html(json.PRMS_descrition);
                                document.getElementById('PRMS_description_alerta').style.display = 'inherit';
                            }
                        } else if (xhr.status == 401) {
                            document.getElementById('alerta').style.display = 'inherit';
                        }
                    },

                });
            } else {
                alert('No se ha modificado el rol')
            }
        });

        $("#atras").on('click', function(e) {
            e.preventDefault();
            var url = 'Permisos';
            location.href = url;
        });
    });

</script>
