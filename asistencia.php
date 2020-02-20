<?php 
include './addons/config.php';
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Panel ~ Asistencia</title>
        <link rel="shortcut icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Equipo Desarrollo">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/login.css"/>
        <link rel="stylesheet" href="css/propio.css"/>
    </head>
    <body >
    <style>
            body{
                background: #eaeaea;
            }
    </style>
    <div class="container-fluid">
        <div class="rows"><br><br>
        <div class="col-lg-8 col-lg-offset-2">
            <div class="light2">
            <img src="img/logo.png" width="200px" height="80">
            <div class="row"> 
                <center><h1><small class="text-black">Asistencia</small></h1></center>
            <center><h3><small>Asistencia General.</small></h1></center>
            </div> 
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form name="form" role="form" method="post" action="actions/asistencia.php">            
                            <div class="form-group">
                                <label  id="inicioSesion" for="usrname" class="h4" > Numero del Empleado:</label>
                                <input type="text" class="form-control" id="passRe" name="numEmpleado" placeholder="Ingresa el Numero" autofocus required>
                            </div><br>
                            <button type="submit" name="asistenciaEmpleado" class="btn btn-primary btn-lg"> Enviar</button>
                        </form>
                    
                </div>
              </div>
            </div>
        </div>
    </div>
          
        </div>
</body>
</html>
