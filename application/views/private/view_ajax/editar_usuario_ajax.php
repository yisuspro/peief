<div class="row">
    <div class="containerAjax">

        <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
        <div class="col-md-12">
            <div class="portlet light portlet-fit  calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-users font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">EDITAR USUARIOS</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= form_open('','id="frm_editar_usuario"');?>
                        <div class="form-wizard">
                            <div class="form-group">
                                <div class="alert alert-danger" id="USER_identification_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('USER_identification') ?>
                                    </div>
                                </div>
                                <input type="hidden" id="USER_PK_hidden" value="<?= $USER_PK; ?>">
                                <div class="col-lg-6">
                                    <label>Documento</label>
                                    <div class="input-group" id="USER_identification">
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        <input type="text" id="USER_identification" name="USER_identification" class="form-control is-invalid" placeholder="Documento de identidad" value="<?= $USER_identification; ?>">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label> Tipo de Documento</label>
                                    <select class="form-control" name="USER_FK_type_identification" id="USER_FK_type_identification" value="<?= $USER_FK_type_identification; ?>">
                                    <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                    <option value="1">C.C.</option>
                                    <option value="2">T.I.</option>
                                    <option value="3">Registro</option>
                                    <option value="4">pasaporte</option>
                                    <option value="5">Option 5</option>
                                </select>
                                </div>
                                <br>
                                <br>
                                <br>

                                <label>Nombres</label>
                                <div class="input-group" id="USER_names"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="USER_names" name="USER_names" class="form-control" placeholder="Nombres" value="<?= $USER_names; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="USER_names_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error('USER_names') ?>
                                    </div>
                                </div>


                                <label>Apellidos</label>
                                <div class="input-group" id="USER_lastnames"><span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    <input type="text" id="USER_lastnames" name="USER_lastnames" class="form-control" placeholder="Apellidos" value="<?= $USER_lastnames; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="USER_lastnames_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('USER_lastnames') ?>
                                    </div>
                                </div>

                                <label>Correo</label>
                                <div class="input-group" id="USER_email"><span class="input-group-addon"><i class="fa fa-at"></i></span>
                                    <input type="email" id="USER_email" name="USER_email" class="form-control" placeholder="Correo" value="<?= $USER_email; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="USER_email_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('USER_email') ?>
                                    </div>
                                </div>

                                <label>Direccion</label>
                                <div class="input-group" id="USER_address"><span class="input-group-addon"><i class="fa fa-industry"></i></span>
                                    <input type="text" id="USER_address" name="USER_address" class="form-control" placeholder="Direccion" value="<?= $USER_address; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="USER_address_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('USER_address') ?>
                                    </div>
                                </div>



                                <label>Telefono</label>
                                <div class="input-group" id="USER_telephone"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" id="USER_telephone" name="USER_telephone" class="form-control" placeholder="Telefono" value="<?= $USER_telephone; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="USER_telephone_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('USER_telephone') ?>
                                    </div>
                                </div>

                                <label>Contraseña</label>
                                <div class="input-group" id="USER_password"><span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                    <input type="text" id="USER_password" name="USER_password" class="form-control" placeholder="Contraseña" value="<?= $USER_password; ?>">
                                </div>
                                <div class="alert alert-danger invalid-feedback" id="USER_password_alerta" role="alert" style="display:none">
                                    <div class="invalid-feedback">
                                        <?= form_error ('USER_password') ?>
                                    </div>
                                </div>

                                <label> Genero</label>
                                <div class="input-group" name="USER_FK_gender" id="USER_FK_gender"><span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                                    <select class="form-control" id="USER_FK_gender" name="USER_FK_gender" value="<?= $USER_FK_gender; ?>">
                                                 
                                                                <option value="1">Masculino</option>
                                                                <option value="2">Femenino</option>
                                                                <option value="3">Otro</option>
                                                            </select>
                                </div>
                                <label> Estado</label>
                                <div class="input-group" name="USER_FK_state" id="USER_FK_state"><span class="input-group-addon"><i class="fa fa-check"></i></span>
                                    <select class="form-control" id="USER_FK_state" name="USER_FK_state" value="<?= $USER_FK_state; ?>">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
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
        $("#frm_editar_usuario").submit(function(event) {
            event.preventDefault();
            var tr = $('#USER_PK_hidden').val();
            var nombre = $('INPUT[name="USER_names"]').val()+"  "+ $('INPUT[name="USER_lastnames"]').val();
            Modificar = confirm("Seguro desea actualizar el usuario " + nombre);
            if (Modificar) {
                $.ajax({
                    async: false,
                    url: 'modificarUsuario/' + tr,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data, xhr) {
                        document.getElementById('USER_identification_alerta').style.display = 'none';
                        document.getElementById('USER_names_alerta').style.display = 'none';
                        document.getElementById('USER_lastnames_alerta').style.display = 'none';
                        document.getElementById('USER_email_alerta').style.display = 'none';
                        document.getElementById('USER_address_alerta').style.display = 'none';
                        document.getElementById('USER_telephone_alerta').style.display = 'none';
                        document.getElementById('USER_password_alerta').style.display = 'none';
                        document.getElementById('alerta_principal').style.display = 'inherit';
                        
                        location.href ="listarUsuarios";

                    },
                    error: function(xhr) {
                        document.getElementById('USER_identification_alerta').style.display = 'none';
                        document.getElementById('USER_names_alerta').style.display = 'none';
                        document.getElementById('USER_lastnames_alerta').style.display = 'none';
                        document.getElementById('USER_email_alerta').style.display = 'none';
                        document.getElementById('USER_address_alerta').style.display = 'none';
                        document.getElementById('USER_telephone_alerta').style.display = 'none';
                        document.getElementById('USER_password_alerta').style.display = 'none';
                        if (xhr.status == 402) {
                            var json = JSON.parse(xhr.responseText);
                            if (json.USER_identification.length != 0) {
                                $("#USER_identification_alerta > div").html(json.USER_identification);
                                document.getElementById('USER_identification_alerta').style.display = 'inherit';
                            }
                            if (json.USER_names.length != 0) {
                                $("#USER_names_alerta > div").html(json.USER_names);
                                document.getElementById('USER_names_alerta').style.display = 'inherit';
                            }
                            if (json.USER_lastnames.length != 0) {
                                $("#USER_lastnames_alerta > div").html(json.USER_lastnames);
                                document.getElementById('USER_lastnames_alerta').style.display = 'inherit';
                            }
                            if (json.USER_email.length != 0) {
                                $("#USER_email_alerta > div").html(json.USER_email);
                                document.getElementById('USER_email_alerta').style.display = 'inherit';
                            }
                            if (json.USER_address.length != 0) {
                                $("#USER_address_alerta > div").html(json.USER_address);
                                document.getElementById('USER_address_alerta').style.display = 'inherit';
                            }
                            if (json.USER_telephone.length != 0) {
                                $("#USER_telephone_alerta > div").html(json.USER_telephone);
                                document.getElementById('USER_telephone_alerta').style.display = 'inherit';
                            }
                            if (json.USER_password.length != 0) {
                                $("#USER_password_alerta > div").html(json.USER_password);
                                document.getElementById('USER_password_alerta').style.display = 'inherit';
                            }
                        } else if (xhr.status == 401) {
                            document.getElementById('alerta').style.display = 'inherit';
                        }
                    },

                });
            } else {
                alert('No se ha modificado el usuario')
            }
        });

        $("#atras").on('click', function(e) {
            e.preventDefault();
            var url = 'listarUsuarios';
            location.href ="listarUsuarios";
        });
    });

</script>
