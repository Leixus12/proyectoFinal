<?php 
include './addons/config.php';
if(!isset($_GET['pass'])){
    
}else{
    $var = $_GET['pass'];
}
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Panel - Recuperar contraseña</title>
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
   <?php 
   if(!isset($_GET['pass'])){
    ?>
    <div class="container-fluid">
        <div class="rows"><br><br>
        <div class="col-lg-8 col-lg-offset-2">
            <div class="light2">
            <img src="img/logo.png" width="200px" height="80">
            <div class="row"> 
                <center><h1><small class="text-black">¿Olvidaste tu contraseña?</small></h1></center>
            <center><h3><small>Introduce tu correo electrónico.</small></h1></center>
            </div> 
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form name="form" role="form" method="post" action="actions/password.php">            
                            <div class="form-group">
                                <label  id="inicioSesion" for="usrname" class="h4" > Email:</label>
                                <input type="email" class="form-control" id="passRe" name="email" placeholder="Ingresa tu email" autofocus required>
                            </div><br>
                            <button type="submit" name="passNew" class="btn btn-primary btn-lg"> Enviar</button>
                        </form>
                    
                </div>
                <div class="col-lg-12 text-center">
                        <div class="col-lg-6">
                        <label class="h5 text-left"><a href="<?php echo $link;?>/index.php" class="text-muted">Iniciar Sección</a></label>
                        </div>
                        <div class="col-lg-6">
                        <label class="h5 text-right"><a href="<?php echo $link;?>/forgot.php" class="text-muted"></a></label>
                        </div>
                    </div>
              </div>
            </div>
        </div>
    </div>
          
        </div>
        <?php 
            }else{
        ?>
        <div class="container-fluid">
        <div class="rows"><br><br>
        <div class="col-lg-8 col-lg-offset-2">
            <div class="light2">
            <img src="img/logo.png" width="200px" height="80">
            <div class="row"> 
                <center><h1><small class="text-black">Recuperacion de contraseña</small></h1></center>
            <center><h3><small>Introduce una nueva contraseña.</small></h1></center>
            </div> 
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form name="form" role="form" method="post" action="actions/password.php">
                            <div class="form-group">
                                <label for="usrname" class="h4" > Nueva contraseña:</label>
                                <input type="password" class="form-control" name="passNew" placeholder="Contraseña Nueva" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="usrname" class="h4" > Repita la contraseña:</label>
                                <input type="password" class="form-control" name="passNewRe" placeholder="Repita la contraseña"required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="passRe" name="codeRe" placeholder="Codigo de verificacion" value="<?php echo $var;?>" style="visibility:hidden" required>
                            </div>
                            <button type="submit" name="passCode" class="btn btn-primary btn-lg">Recuperar</button>
                        </form>
                    
                </div>
              </div>
            </div>
        </div>
    </div>
          
        </div>
        <?php 
            }
        ?>
</body>
</html>
