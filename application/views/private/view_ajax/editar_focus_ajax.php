<div class="row">
    <div class="containerAjax">
        <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
        <div class="col-md-12">
            <div class="portlet light portlet-fit  calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-map font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">EDITAR ENFOQUE</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= form_open('','id="frm_editar_plan"');?>
                        <div class="form-wizard">
                            <div class="form-group">
                                <input type="hidden" id="FOCS_PK_hidden" value="<?php echo $FOCS_PK; ?>">
                                <label>Nombre del enfoque</label>
                                <div class="input-group" id="FOCS_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="FOCS_name" name="FOCS_name" class="form-control" placeholder="Nombre" value="<?php echo $FOCS_name; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="FOCS_name_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('FOCS_name') ?>
                                    </div>
                                </div>
                                <label>Descripcion</label>
                                <div class="input-group" id="FOCS_description"><span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                                    <input type="text" id="FOCS_description" name="FOCS_description" class="form-control" placeholder="Descripcion" value="<?php echo $FOCS_description; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="FOCS_description_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('FOCS_description') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="modal-footer">
                                        <?= form_submit('agregar', 'Agregar','class="btn btn-success"') ?>
                                            <a class="btn btn-danger atras" type="button" href="#" id="atras" name="atras">Cancelar</a>
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
        $("#frm_editar_plan").submit(function(event) {
            event.preventDefault();
            var tr = $('#FOCS_PK_hidden').val();
            eliminar = confirm("Seguro desea actualizar el plan " + tr);
            if (eliminar) {
                $.ajax({
                    async: false,
                    url: 'Focus/modificarFocus/' + tr,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data, xhr) {
                        document.getElementById('FOCS_name_alerta').style.display = 'none';
                        location.href = "Focus";

                    },
                    error: function(xhr) {
                        document.getElementById('FOCS_name_alerta').style.display = 'none';
                        if (xhr.status == 402) {
                            var json = JSON.parse(xhr.responseText);

                            if (json.FOCS_name.length != 0) {
                                $("#FOCS_name_alerta > div").html(json.FOCS_name);
                                document.getElementById('FOCS_name_alerta').style.display = 'inherit';
                            }
                            if (json.FOCS_description.length != 0) {
                                $("#FOCS_description_alerta > div").html(json.FOCS_description);
                                document.getElementById('FOCS_description_alerta').style.display = 'inherit';
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
            var url = 'Focus';
            location.href = url;
        });
    });

</script>
