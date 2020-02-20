
<?php 
include './addons/config.php';
include './class/asistencia.php';
include './class/conexion.php';
$asistencia = new asistencia();
$idAsis=$_GET['asis'];
$asistencia->datosAsis($idAsis);
session_start();
if (isset($_SESSION['idPuesto']) == 1 || isset($_SESSION['idPuesto']) == 6){
?>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Panel: Editar Nominas</title>
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="css/cosmos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/propio.css">
    <script src="js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="js/propio.js?v11"></script>
    <script type="text/javascript">
function confirmar()
{
	if(confirm('¿Estas seguro de realizar esta acción?')){
            return true;
        }else{
        }return false;
}
</script>
    </head>
    <body >
    <?php include './addons/menuP.php'; ?>
    <div class="container-fluid">
        <div class="rows">
        <div class="col-lg-12">
            <div class="light">
                <form action="actions/mod_asistencia.php"  method="post">
                    <div class="col-lg-12">
                <div class="form-group col-lg-3">
                <h6 class="card-subtitle mb-2 text-muted">Fecha:</h6>
                <input class="form-control" style="height: 35px;" type="date" name="fecha" value="<?php echo $asistencia->getFecha(); ?>" readonly>
                </div>
                
                    </div>
                <div class="col-lg-12">
                <div class="form-group col-lg-3">
                <h6 class="card-subtitle mb-2 text-muted">Hora de Entrada:</h6>
                <p class="card-text">
                    <input class="form-control" style="height: 35px;" type="time" name="horaEntrada" value="<?php echo $asistencia->getHoraEntrada(); ?>">
                    </p>
                </div>
                <div class="form-group col-lg-3">
                <h6 class="card-subtitle mb-2 text-muted">Hora de Salida:</h6>
                <p class="card-text">
                    <input class="form-control" style="height: 35px;" type="time" name="horaSalida" value="<?php echo $asistencia->getHoraSalida(); ?>">
                    </p>
                </div>
                </div>
                <div class="col-lg-12">
                <div class="form-group col-lg-6">
                <h6 class="card-subtitle mb-2 text-muted">Empleado:</h6>
                <p class="card-text">
                    <input class="form-control" style="height: 35px;" type="text" name="empleado" value="<?php echo $asistencia->getIdEmpleado(); ?>" readonly>
                    </p>
                </div>
                <input style="height: 35px;display: none;" type="text" name="idVacaciones" value="<?php echo $asistencia->getIdAsistencia(); ?>">
                
                    </div>
                <hr>
                <button class="btn btn-primary btn-lg" onclick="return confirmar()" name="actAsistencia" type="submit">Modificar</button>
                <a href="<?php echo $link;?>/buscarAsistencia.php" class="btn btn-primary btn-lg col-lg-offset-1">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
          
        </div>
</body>
</html>
<?php
}else{
    header("Location: panel.php");
}
?>
