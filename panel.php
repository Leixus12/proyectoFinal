<?php
include 'addons/config.php';
include './addons/activo.php';
include 'class/conexion.php';
include 'class/empleado.php';
$empleado = new empleado();
$idEmpleado = $_SESSION['idEmpleado'];
$empleado->consultaDatos($idEmpleado);
$empleado->DatosLabores($idEmpleado);
?>
<html>
    <head>
        <title>Panel ~ Inicio</title>
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/propio.css">
    <link href="css/cosmos.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="js/propio.js?v11"></script>
    </head>
    <body>
        <?php include './addons/menu.php'; ?>
        <div class="rows">
            <div class="container">
                <div class="col-lg-12 light">
                    <div class="col-lg-6">
                        <div class="h3">
                            <center><label class="h2" >Bienvenido al Panel</label></center>
                            <b class="text-black">Hola,<?php echo $empleado->getNombre()." ".$empleado->getApellidoPaterno()." ".$empleado->getApellidoMaterno(); ?> en este sitio podrás ver todo lo relacionado con tu puesto laboral.</b>
                            <br><br><center><img src="<?php echo $empleado->getFoto(); ?>" width="128" height="128"></center>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 text-center">
                        <div class="h3">
                            <center><label class="h2 text-black" >Datos Laborares</label></center>
                            <div class="form-group col-lg-6">
                                <label class="text-black">Sucursal:</label>
                                <input class="form-control text-center" name="Sucursal" value="<?php echo $empleado->getNomSucursal(); ?>" readonly>
                            </div>
                                <div class="form-group col-lg-6">
                                <label class="text-black">Departamento:</label>
                                <input class="form-control text-center" name="Departamento" value="<?php echo $empleado->getNomDepartamento(); ?>" readonly>
                                </div>
                            <div class="form-group col-lg-6">
                                <label class="text-black">Puesto:</label>
                                <input class="form-control text-center" name="Puesto" value="<?php echo $empleado->getNomPuesto(); ?>" readonly>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="text-black">Turno:</label>
                                <input class="form-control text-center" name="Turno" value="<?php echo $empleado->getNomTurno(); ?>" readonly>
                                </div>
                            <div class="form-group col-lg-12">
                            <label class="text-black">Fecha de Ingreso:</label>
                            <input class="form-control text-center" name="FechaIni" value="<?php echo $empleado->getFechaIngreso(); ?>" readonly>
                        </div>
                        <div class="form-group col-lg-6 text-center">
                            <label class="text-black">NSS:</label>
                            <input class="form-control text-center" name="Nss" value="<?php echo $empleado->getNss(); ?>" readonly>
                        </div>
                        <div class="form-group col-lg-6 text-center">
                            <label class="text-black">RFC:</label>
                            <input class="form-control text-center" name="RFC" value="<?php echo $empleado->getRfc(); ?>" readonly>
                        </div>
                    </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <?php include './addons/footer.php'; ?>
    </body>
</html>

