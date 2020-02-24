<?php
include '../class/conexion.php';
include '../class/puesto.php';
include '../addons/config.php';

$puesto = new puesto();

/**
 * Validacion para modificar los datos de los puestos desde el panel de 
 * adminsitracion
 */
if(isset($_POST['modPuesto'])){
    $puesto->setNombrePuest($_POST['nomPuesto']);
    $puesto->setDescripcion($_POST['descPuest']);
    $puesto->setSalarioDia($_POST['salPuesto']);
    $idPuesto = $_POST['idPuesto'];
    $puesto->actPuestoDatos($idPuesto);
    echo '<script>location.href ="'.$link.'/buscarPuestos.php";</script>';
}elseif (isset ($_POST['crearPuesto'])){
    $puesto->setNombrePuest($_POST['nomPuesto']);
    $puesto->setDescripcion($_POST['descPuest']);
    $puesto->setSalarioDia($_POST['salPuesto']);
    $puesto->crearPuesto();
    echo '<script>location.href ="'.$link.'/buscarPuestos.php";</script>';
    
}
?>

