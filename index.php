<?php
include './addons/config.php';

session_start();
if (isset($_SESSION['valido']) == 1) {
    header("Location: panel.php");
} else {
    ?>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Panel - Login.</title>
            <link rel="shortcut icon" href="favicon.ico">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="author" content="Equipo Desarrollo">
            <link rel="stylesheet" href="css/bootstrap.css">
            <link rel="stylesheet" href="css/propio.css"/>
            <link rel="stylesheet" href="css/login.css"/>
        </head>
    <body >
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-7">
                        <div class="login">
                            <div class="row">
                                <img src="img/logo.png">
                            </div>
                            <div class="row">
                                <form name="form" role="form" method="post" 
                                      action="actions/validar.php">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class="form-group espacio">
                                            <input type="text" class="form-control" 
                                               id="usrname" 
                                               name="user" 
                                               placeholder="Usuario" 
                                               required pattern="[A-Za-z].+"
                                               title="Caracteres inválidos" 
                                               autofocus required>
                                        </div>
                                        <div class="form-group espacio">
                                        <input type="password" 
                                               class="form-control" 
                                               id="psw" name="pwd" 
                                               placeholder="Contraseña" 
                                               required="password">
                                        </div>
                                        <button type="submit" 
                                            class="col-sm-offset-7 btn btn-primary btn-md">
                                            ENTRAR
                                        </button>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <label class="h5">
                                        <a 
                                           href="
                                                <?php echo $link; ?>/forgot.php
                                                " 
                                            class="text-muted espacio">
                                            ¿Olvidaste tu contraseña?:
                                        </a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>