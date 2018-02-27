<div class="row">
    <div class="containerAjax">

        <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
        <div class="col-md-12">
            <div class="portlet light portlet-fit  calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-users font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">EDITAR UNIDAD PEDAGOGICA</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= form_open('','id="frm_editar_unidad"');?>
                        <div class="form-wizard">
                            <div class="form-group">
                                <div class="alert alert-danger" id="LNUT_PK_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?php echo form_error ('LNUT_PK') ?>
                                    </div>
                                </div>
                                <input type="hidden" id="LNUT_PK_hidden" value="<?php echo $LNUT_PK; ?>">


                                <label>Nombre unidad</label>
                                <div class="input-group" id="LNUT_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="LNUT_name" name="LNUT_name" class="form-control" placeholder="Nombre" value="<?php echo $LNUT_name; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="LNUT_name_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('LNUT_name') ?>
                                    </div>
                                </div>
                                <label>Descripcion</label>
                                <div class="input-group" id="LNUT_description"><span class="input-group-addon"><i class="fa fa-book"></i></span>
                                    <input type="text" id="LNUT_description" name="LNUT_description" class="form-control" placeholder="Direccion" value="<?php echo $LNUT_description; ?>">
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
                                <option value="<?php echo $LNUT_FK_focus;?>"><?php echo $FOCS_name; ?></option>
                                <?php foreach($focus->result_array() as $r) { ?>
                                <option value="<?php echo $r['FOCS_PK'];?>"><?php echo $r['FOCS_name']; ?></option>
                                <?php }?>
                            </select>
                            
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
        $("#frm_editar_unidad").submit(function(event) {
            event.preventDefault();
            var tr = $('#LNUT_PK_hidden').val();
            eliminar = confirm("Seguro desea actualizar la unidad " + tr);
            if (eliminar) {
                $.ajax({
                    async: false,
                    url: 'Learning_units/modificarUnidades/' + tr,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data, xhr) {
                        document.getElementById('LNUT_name_alerta').style.display = 'none';
                        document.getElementById('LNUT_description_alerta').style.display = 'none';
                        location.href = "Learning_units";

                    },
                    error: function(xhr) {
                        document.getElementById('LNUT_name_alerta').style.display = 'none';
                        document.getElementById('LNUT_description_alerta').style.display = 'none';
                        if (xhr.status == 402) {
                            var json = JSON.parse(xhr.responseText);
                            
                            if (json.LNUT_name.length != 0) {
                                $("#LNUT_name_alerta > div").html(json.LNUT_name);
                                document.getElementById('LNUT_name_alerta').style.display = 'inherit';
                            }
                            if (json.LNUT_description.length != 0) {
                                $("#LNUT_description_alerta > div").html(json.LNUT_description);
                                document.getElementById('LNUT_description_alerta').style.display = 'inherit';
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
            var url = 'Learning_units';
            location.href = url;
        });
    });

</script>
