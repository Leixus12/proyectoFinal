<?php
include 'addons/config.php';
include './addons/activo.php';
include 'class/conexion.php';
include 'class/empleado.php';
include './class/vacaciones.php';
$vacaciones = new vacaciones();
$idEmpleado=$_SESSION['idEmpleado'];

$empleado = new empleado();
$empleado->consultaDatos($_SESSION['idEmpleado']);
$cuerpo='';
$alerta="";
if(!isset($_GET['message'])){
    $alerta="";
} else {
    $alerta=$_GET['message'];
}
$fechaInicial = $empleado->getFechaIngreso();
$fechaActual = date('Y-m-d'); // la fecha del ordenador
$diff = abs(strtotime($fechaActual) - strtotime($fechaInicial));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
if($years == 0){
    $diasVacaciones ="Actualmente no tienes dias disponibles";
}elseif($years == 1){
    $diasVacaciones = 6;
}elseif ($years==2) {
    $diasVacaciones=8;
}elseif ($years==3) {
    $diasVacaciones=10;
}elseif ($years==4) {
    $diasVacaciones=12;
}elseif ($years >= 5 && 9 <= $years) {
    $diasVacaciones=14;
}
$diasVacaciones=$vacaciones->diasP($idEmpleado, $diasVacaciones);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $nombre;?> ~ Vacaciones</title>
<link rel="stylesheet" href="<?php echo $link;?>/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="<?php echo $link;?>/js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="<?php echo $link;?>/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="<?php echo $link;?>/js/propio.js?v11"></script>
<link href="<?php echo $link;?>/css/propio.css" rel="stylesheet">
</head>
<body>
<div id="preloader">
<div id="status">&nbsp;</div>
</div>
<div id="fb-root"></div>
<?php include 'addons/menu.php'; ?>
<?php
    if(!isset($_GET['tab'])){}
    else{
        $cuerpo=$_GET['tab'];
    }
    if(!isset($_GET['tab'])){
        include 'vacaciones/vacaciones.php';
    }elseif($cuerpo == 2){
        include 'vacaciones/vacaciones2.php';
    }
?>
</body>
</html>