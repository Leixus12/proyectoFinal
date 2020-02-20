<?php
 include '../class/conexion.php';
 include '../class/isr.php';
 include '../addons/config.php';

 $isr = new isr();
 $idISR = $_POST['idIsr'];

 $isr->setMonto($_POST['montoIsr']);
 $isr->setMontoPorcentaje($_POST['porcentajeIsr']);
 $isr->actISR($idISR);
 echo '<script>location.href ="'.$link.'/buscarIsr.php";</script>';
?>
