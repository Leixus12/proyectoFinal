<?php
include 'addons/config.php';
include './addons/activo.php';
include 'class/conexion.php';
include 'class/empleado.php';
$empleado = new empleado();
$empleado->consultaDatos($_SESSION['idEmpleado']);
$cuerpo='';
$randomS = $random_string = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
$randomN = $random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
$nombreFoto = $randomS.$randomN;
if(!isset($_GET['message'])){
    $alerta="";
} else {
    $alerta=$_GET['message'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $nombre;?> ~ Ajustes</title>
<link rel="stylesheet" href="<?php echo $link;?>/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="<?php echo $link;?>/js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="<?php echo $link;?>/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link href="<?php echo $link;?>/css/propio.css" rel="stylesheet">
<script src="<?php echo $link;?>/js/propio.js?v11"></script>
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
<body>
<div id="preloader">
<div id="status">&nbsp;</div>
</div>
<div id="fb-root"></div>
<?php include './addons/menu.php'; ?>
<?php
    if(!isset($_GET['tab'])){}
    else{
        $cuerpo=$_GET['tab'];
    }
    if(!isset($_GET['tab'])){
        include 'profile/profile.php';
    }elseif($cuerpo == 2){
        include 'profile/profile2.php';
    }elseif($cuerpo == 3){
        include 'profile/profile3.php';
    }
?>
</body>
</html>