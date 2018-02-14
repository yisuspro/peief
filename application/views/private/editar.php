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
                <?= form_open('Usuarios/registrar','id="frm_agregar_usuario"');?>
                    <div class="form-wizard">
                        <div class="form-group">
                            <div class="alert alert-danger" id="USER_PK_alerta" role="alert" style="display:none">
                                <div class="invalid-feedback">
                                    <?php echo form_error ('USER_PK') ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Documento</label>

                                <div class="input-group" id="USER_PK">
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    <input type="text" id="USER_PK" name="USER_PK" class="form-control is-invalid" placeholder="Documento de identidad">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label> Tipo de Documento</label>
                                <select class="form-control" name="USER_FK_type_identification" id="USER_FK_type_identification">
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
                                <input type="text" id="USER_names" name="USER_names" class="form-control" placeholder="Nombres">
                            </div>
                            <div class="alert alert-danger invalid-feedback" id="USER_names_alerta" role="alert" style="display:none">
                                <div class="invalid-feedback">
                                    <?php echo form_error('USER_names') ?>
                                </div>
                            </div>


                            <label>Apellidos</label>
                            <div class="input-group" id="USER_lastnames"><span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <input type="text" id="USER_lastnames" name="USER_lastnames" class="form-control" placeholder="Apellidos">
                            </div>
                            <div class="alert alert-danger invalid-feedback" id="USER_lastnames_alerta" role="alert" style="display:none">
                                <div class="invalid-feedback">
                                    <?= form_error ('USER_lastnames') ?>
                                </div>
                            </div>

                            <label>Correo</label>
                            <div class="input-group" id="USER_email"><span class="input-group-addon"><i class="fa fa-at"></i></span>
                                <input type="email" id="USER_email" name="USER_email" class="form-control" placeholder="Correo">
                            </div>
                            <div class="alert alert-danger invalid-feedback" id="USER_email_alerta" role="alert" style="display:none">
                                <div class="invalid-feedback">
                                    <?= form_error ('USER_email') ?>
                                </div>
                            </div>

                            <label>Direccion</label>
                            <div class="input-group" id="USER_address"><span class="input-group-addon"><i class="fa fa-industry"></i></span>
                                <input type="text" id="USER_address" name="USER_address" class="form-control" placeholder="Direccion">
                            </div>
                            <div class="alert alert-danger invalid-feedback" id="USER_address_alerta" role="alert" style="display:none">
                                <div class="invalid-feedback">
                                    <?= form_error ('USER_address') ?>
                                </div>
                            </div>



                            <label>Telefono</label>
                            <div class="input-group" id="USER_telephone"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" id="USER_telephone" name="USER_telephone" class="form-control" placeholder="Telefono">
                            </div>
                            <div class="alert alert-danger invalid-feedback" id="USER_telephone_alerta" role="alert" style="display:none">
                                <div class="invalid-feedback">
                                    <?= form_error ('USER_telephone') ?>
                                </div>
                            </div>

                            <label>Contraseña</label>
                            <div class="input-group" id="USER_password"><span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                <input type="password" id="USER_password" name="USER_password" class="form-control" placeholder="Contraseña">
                            </div>
                            <div class="alert alert-danger invalid-feedback" id="USER_password_alerta" role="alert" style="display:none">
                                <div class="invalid-feedback">
                                    <?= form_error ('USER_password') ?>
                                </div>
                            </div>

                            <label> Genero</label>
                            <div class="input-group" name="USER_FK_gander" id="USER_FK_gender"><span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                                <select class="form-control" id="USER_FK_gander" name="USER_FK_gander">
                                                                <option value="1">Masculino</option>
                                                                <option value="2">Femenino</option>
                                                                <option value="3">Otro</option>
                                                            </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="modal-footer">
                                    <?= form_submit('agregar', 'Editar','class="btn btn-warning"') ?>
                                        <a class="btn btn-danger" type="button" href="#" id="cerrar" name="cerrar">Cancelar</a>
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
