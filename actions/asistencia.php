<?php
include '../class/asistencia.php';
include '../class/conexion.php';
include '../addons/config.php';
$asistencia = new asistencia();

/**
 * Validacion del formulario del registro de asistencias por empleado.
 */
    if(isset($_POST['asistenciaEmpleado'])){
        date_default_timezone_set("America/Mexico_City");
        $fechaAct= date("Y-m-d");
        $horaAct = date("H:i:s");
        $idEmpleado= $_POST['numEmpleado'];
        $asistencia->reg_asistencia($fechaAct,$horaAct,$horaAct,$idEmpleado);
        echo '<script>location.href ="'.$link.'/asistencia.php?message=save";'
                . '</script>';
    }
?>
