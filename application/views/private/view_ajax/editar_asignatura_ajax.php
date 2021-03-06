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
                    <?= form_open('','id="frm_editar_asignatura"');?>
                    <input type="hidden" id="SBJC_PK_hidden" value="<?= $SBJC_PK; ?>">
                        <div class="form-wizard">
                            <div class="form-group"><label>Nombre asignatura</label>
                                <div class="input-group" id="SBJC_name"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="SBJC_name" name="SBJC_name" class="form-control" placeholder="Nombre" value="<?= $SBJC_name; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="SBJC_name_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error('SBJC_name') ?>
                                    </div>
                                </div>
                                <label>Descripcion</label>
                                <div class="input-group" id="SBJC_description"><span class="input-group-addon"><i class="fa fa-book"></i></span>
                                    <textarea type="text" id="SBJC_description" name="SBJC_description" class="form-control" placeholder="Direccion" ><?= $SBJC_description; ?></textarea>
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
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label> Docentes</label>
                                            <select class="form-control" name="SBJC_FK_users_teacher" id="SBJC_FK_users_teacher">
                                                <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                                <option value="">Seleccione una Docente...</option>
                                            </select>
                                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="modal-footer">
                                        <?= form_submit('agregar', 'editar','class="btn btn-success"') ?>
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
        
        document.getElementById('SBJC_FK_learning_units').onchange = function(){
            
            listadocentes=<?= json_encode($docentes->result_array(), JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;        
            var lista=[];
            
            listadocentes.forEach(function(element) {
                if(!lista[element.USLE_FK_learning_units]){
                    lista.push(element.USLE_FK_learning_units);
                    lista[element.USLE_FK_learning_units]=Array({"Nombre":element.Nombre,"PK":element.USLE_PK});
                }else{
                    var newdata ={'Nombre': element.Nombre,'PK' :element.USLE_PK};
                    lista[element.USLE_FK_learning_units].push(newdata);
                }
            });
            
            var unidad = document.getElementById('SBJC_FK_learning_units');
            var docentes = document.getElementById('SBJC_FK_users_teacher');
            var unidadSeleccionada = unidad.value;
            
            docentes.innerHTML = '<option value="">Seleccione un Docente...</option>';
            
            if(unidadSeleccionada !== ''){
                unidadSeleccionada = lista[unidadSeleccionada];
    
                unidadSeleccionada.forEach(function(docente){
                    let opcion = document.createElement('option');
                    opcion.value = docente.PK;
                    opcion.text = docente.Nombre;
                    docentes.add(opcion);
                });
            }
                
        };
        
        
        
        
        $("#frm_editar_asignatura").submit(function(event) {
            event.preventDefault();
            var tr = $('#SBJC_PK_hidden').val();
            eliminar = confirm("Seguro desea actualizar el rol " + tr);
            if (eliminar) {
                $.ajax({
                    async: false,
                    url: 'Subjects/modificarAsignatura/' + tr,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data, xhr) {
                        document.getElementById('SBJC_name_alerta').style.display = 'none';
                        document.getElementById('SBJC_description_alerta').style.display = 'none';
                        location.href = "Subjects";

                    },
                    error: function(xhr) {
                        document.getElementById('SBJC_name_alerta').style.display = 'none';
                        document.getElementById('SBJC_description_alerta').style.display = 'none';
                        if (xhr.status == 402) {
                            var json = JSON.parse(xhr.responseText);
                            if (json.SBJC_name.length != 0) {
                                $("#SBJC_name_alerta > div").html(json.SBJC_name);
                                document.getElementById('SBJC_name_alerta').style.display = 'inherit';
                            }
                            if (json.SBJC_description.length != 0) {
                                $("#SBJC_description_alerta > div").html(json.SBJC_descrition);
                                document.getElementById('SBJC_description_alerta').style.display = 'inherit';
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
            var url = 'Subjects';
            location.href = url;
        });
    });
</script>
