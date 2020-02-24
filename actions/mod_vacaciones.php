<?php

/**
 * Validacion para modificar las solicitudes vacaciones de los usuarios
 * desde el panel de adminsitracion
 */
 include '../class/vacaciones.php';
 include '../class/conexion.php';
 include '../addons/config.php';
 $vacaciones= new vacaciones();
 $vacaciones->setFechaIni($_POST['fechaInicial']);
 $vacaciones->setFechaFin($_POST['fechaFinal']);
 $vacaciones->setEstado($_POST['estado']);
 $vacaciones->setIdVacaciones($_POST['idVacaciones']);
 $vacaciones->actVac();
 echo '<script>location.href ="'.$link.'/peticiones.php";</script>';
?>
