<?php
 include '../class/asistencia.php';
 include '../addons/config.php';
 include '../class/conexion.php';
 $asistencia= new asistencia();
 $asistencia->setHoraEntrada($_POST['horaEntrada']);
 $asistencia->setHoraSalida($_POST['horaSalida']);
 $asistencia->setIdAsistencia($_POST['idVacaciones']);
 $asistencia->actDatos();
 echo '<script>location.href ="'.$link.'/buscarAsistencia.php";</script>';
?>
