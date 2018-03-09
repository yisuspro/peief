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
                                <input type="hidden" id="CCLS_PK_hidden" value="<?= $CCLS_PK; ?>">
                                <label>Nombre</label>
                                <div class="input-group" id="CCLS_name"><span class="input-group-addon"><i class="fa fa-map"></i></span>
                                    <input type="text" id="CCLS_name" name="CCLS_name" class="form-control" placeholder="Nombre" value="<?= $CCLS_name; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="CCLS_name_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error('CCLS_name') ?>
                                    </div>
                                </div>
                                <label> Tipo de version y plan</label>
                                <select class="form-control" name="CCLS_FK_plans" id="CCLS_FK_plans" value="CCLS_FK_plans">
                                    <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                    <?php foreach($versiones->result_array() as $r) { ?>
                                        <option value="<?= $r['PLAN_PK'];?>"><?= $r['PLAN_name']; ?></option>
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
<script src="assets/js/cicles/agregar_miembro_cicle.js">
</script>
