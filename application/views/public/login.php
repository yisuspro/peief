<?php require_once 'head.php'; ?>
<style>
    .align {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    /* helpers/grid.css */

    .grid {
        margin-left: auto;
        margin-right: auto;
        max-width: 320px;
        max-width: 20rem;
        width: 90%;
    }

    /* helpers/hidden.css */

    .hidden {
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }

    /* helpers/icon.css */

    .icons {
        display: none;
    }

    .icon {
        display: inline-block;
        fill: #606468;
        font-size: 16px;
        font-size: 1rem;
        height: 1em;
        vertical-align: middle;
        width: 1em;
    }

    /* layout/base.css */

    * {
        box-sizing: inherit;
    }

    html {
        box-sizing: border-box;
        font-size: 100%;
        height: 100%;
    }

    body {
        background-color: #2c3338;
        color: #606468;
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
        font-size: 0.875rem;
        font-weight: 400;
        height: 100%;
        line-height: 1.5;
        margin: 0;
        min-height: 100%;
    }

    /* modules/anchor.css */

    a {
        color: #eee;
        outline: 0;
        text-decoration: none;
    }

    a:focus,
    a:hover {
        text-decoration: underline;
    }

    /* modules/form.css */

    input {
        background-image: none;
        border: 0;
        color: inherit;
        font: inherit;
        margin: 0;
        outline: 0;
        padding: 0;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
    }

    input[type='submit'] {
        cursor: pointer;
    }

    .form {
        margin: -14px;
        margin: -0.875rem;
    }

    .form input[type='password'],
    .form input[type='text'],
    .form input[type='submit'] {
        width: 100%;
    }

    .form__field {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin: 14px;
        margin: 0.875rem;
    }

    .form__input {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    /* modules/login.css */

    .login {
        color: #eee;
    }

    .login label,
    .login input[type='text'],
    .login input[type='password'],
    .login input[type='submit'] {
        border-radius: 0.25rem;
        padding: 16px;
        padding: 1rem;
    }

    .login label {
        background-color: #363b41;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        padding-left: 20px;
        padding-left: 1.25rem;
        padding-right: 20px;
        padding-right: 1.25rem;
    }

    .login input[type='password'],
    .login input[type='text'] {
        background-color: #3b4148;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
    }

    .login input[type='password']:focus,
    .login input[type='password']:hover,
    .login input[type='text']:focus,
    .login input[type='text']:hover {
        background-color: #434a52;
    }

    .login input[type='submit'] {
        background-color: #ea4c88;
        color: #eee;
        font-weight: 700;
        text-transform: uppercase;
    }

    .login input[type='submit']:focus,
    .login input[type='submit']:hover {
        background-color: #d44179;
    }

    /* modules/text.css */

    p {
        margin-bottom: 24px;
        margin-bottom: 1.5rem;
        margin-top: 24px;
        margin-top: 1.5rem;
    }

    .text--center {
        text-align: center;
    }

</style>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
<div class="form-group" id="alerta" style="display:none">
    <div class="alert alert-danger" role="alert">
        El correo o contraseña no conciden porfarvor ingresar los datos correspndientes.
    </div>
</div>
<br><br> <br><br> <br><br> <br><br> <br><br> <br><br>
<div class="grid">
    <center>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="<?= base_url('./assets/images/logos/institucion/logo_escudo.png')?>" width="45px" height="45px">
                        <h3 class="panel-title">Login via site</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open(base_url('login/validate'),'id="frm_login"'); ?>
                        <fieldset>
                            <div class="col-sm-8">
                                <label for="exampleImputEmail" clas="fa fa-battery-full">Correo electronico</label>
                            </div>
                            <div class="form-group" id="email">
                                <input class="form-control" placeholder="yourmail@example.com" name="email" type="text" id="email" type="email">
                                <div class="invalid-feedback">
                                    <?php echo form_error ('email') ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="exampleImputpassword">Contraseña</label>
                            </div>
                            <div class="form-group" id="password">
                                
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" id="password">
                                <div class="invalid-feedback">
                                    <?php echo form_error ('password') ?>
                                </div>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                        </fieldset>
                        <?php echo form_close(); ?>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>
<br><br> <br><br> <br><br> <br><br> <br><br> <br><br>

   

<script src="<?= base_url('./assets/js/login.js')?>"></script>
<?php require_once 'foot.php';?>
