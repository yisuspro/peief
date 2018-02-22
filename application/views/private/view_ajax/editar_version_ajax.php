
<div class="row">
    <div class="containerAjax">
        <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
        <div class="col-md-12">
            <div class="portlet light portlet-fit  calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-clone font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">EDITAR VERSION</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= form_open('','id="frm_editar_version"');?>
                        <div class="form-wizard">
                            <div class="form-group">
                                
                                <input type="hidden" id="VRSN_PK_hidden" value="<?php echo $VRSN_PK; ?>">
                                <label>Nombre</label>
                                <div class="input-group" id="VRSN_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="VRSN_name" name="VRSN_name" class="form-control" placeholder="Nombre" value="<?php echo $VRSN_name; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="VRSN_name_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('VRSN_name') ?>
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
        $("#frm_editar_version").submit(function(event) {
            event.preventDefault();
            var tr = $('#VRSN_PK_hidden').val();
            eliminar = confirm("Seguro desea actualizar el plan " + tr);
            if (eliminar) {
                $.ajax({
                    async: false,
                    url: 'Versions/modificarVersion/' + tr,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data, xhr) {
                        document.getElementById('VRSN_name_alerta').style.display = 'none';
                        location.href = "Versions";

                    },
                    error: function(xhr) {
                        document.getElementById('VRSN_name_alerta').style.display = 'none';
                        if (xhr.status == 402) {
                            var json = JSON.parse(xhr.responseText);

                            if (json.VRSN_name.length != 0) {
                                $("#VRSN_name_alerta > div").html(json.VRSN_name);
                                document.getElementById('VRSN_name_alerta').style.display = 'inherit';
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
            var url = 'Versions';
            location.href = url;
        });
    });

</script>
