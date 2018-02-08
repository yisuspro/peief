<!DOCTYPE html>
<html>

<head>
    <title>registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <form action="http://localhost/peief/index.php/Usuarios/registrar" method="post">

        <fieldset>
            <!-- Form Name -->

            <legend>FORMULARIO DE REGISTRO</legend>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">NOMRE DE USUARIO</label>
                <div class="col-md-4">
                    <input id="username" name="username" type="text" placeholder="nick name" class="form-control input-md">
                    <span class="help-block">help</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">NOMBRES</label>
                <div class="col-md-4">
                    <input id="name" name="name" type="text" placeholder="names" class="form-control input-md">
                    <span class="help-block">help</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">APELLIDOS</label>
                <div class="col-md-4">
                    <input id="lastname" name="lastname" type="text" placeholder="lastnames" class="form-control input-md">
                    <span class="help-block">help</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">CORREO</label>
                <div class="col-md-4">
                    <input id="mail" name="mail" type="text" placeholder="mail" class="form-control input-md">
                    <span class="help-block">help</span>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="passwordinput">CONTRASEÑA</label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="password" class="form-control input-md">
                    <span class="help-block">help</span>
                </div>
            </div>
            <!-- Button (Double) -->
            <div class="form-group">
                
                <div class="col-md-8">
                    <button id="button1id" name="button1id" class="btn btn-success">REGISTRAR</button>

                </div>
            </div>

        </fieldset>
    </form>
    

</body>

</html>
