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
                                <div class="alert alert-danger" id="ROLE_PK_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('ROLE_PK') ?>
                                    </div>
                                </div>
                                <input type="hidden" id="ROLE_PK_hidden" value="<?= $ROLE_PK; ?>">
                                <label>Nombre</label>
                                <div class="input-group" id="ROLE_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="ROLE_name" name="ROLE_name" class="form-control" placeholder="Nombre" value="<?= $ROLE_name; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="ROLE_name_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error('ROLE_name') ?>
                                    </div>
                                </div>
                                <label>Nombre corto</label>
                                <div class="input-group" id="ROLE_shortname"><span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    <input type="text" id="ROLE_shortname" name="ROLE_shortname" class="form-control" placeholder="Apellidos" value="<?= $ROLE_shortname; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="ROLE_shortname_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('ROLE_shortname') ?>
                                    </div>
                                </div>
                                <label>Descripcion</label>
                                <div class="input-group" id="ROLE_description"><span class="input-group-addon"><i class="fa fa-book"></i></span>
                                    <input type="text" id="ROLE_description" name="ROLE_description" class="form-control" placeholder="Direccion" value="<?= $ROLE_description; ?>">
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
            var tr = $('#ROLE_PK_hidden').val();
            eliminar = confirm("Seguro desea actualizar el rol " + tr);
            if (eliminar) {
                $.ajax({
                    async: false,
                    url: 'Roles/modificarRol/' + tr,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data, xhr) {
                        document.getElementById('ROLE_name_alerta').style.display = 'none';
                        document.getElementById('ROLE_shortname_alerta').style.display = 'none';
                        document.getElementById('ROLE_description_alerta').style.display = 'none';
                        location.href = "Roles";

                    },
                    error: function(xhr) {
                        document.getElementById('ROLE_name_alerta').style.display = 'none';
                        document.getElementById('ROLE_shortname_alerta').style.display = 'none';
                        document.getElementById('ROLE_description_alerta').style.display = 'none';
                        if (xhr.status == 402) {
                            var json = JSON.parse(xhr.responseText);

                            if (json.ROLE_name.length != 0) {
                                $("#ROLE_name_alerta > div").html(json.ROLE_name);
                                document.getElementById('ROLE_name_alerta').style.display = 'inherit';
                            }
                            if (json.ROLE_shortname.length != 0) {
                                $("#ROLE_shortname_alerta > div").html(json.ROLE_shortname);
                                document.getElementById('ROLE_shortname_alerta').style.display = 'inherit';
                            }
                            if (json.ROLE_description.length != 0) {
                                $("#ROLE_description_alerta > div").html(json.ROLE_description);
                                document.getElementById('ROLE_description_alerta').style.display = 'inherit';
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
            var url = 'Roles';
            location.href = url;
        });
    });

</script>
