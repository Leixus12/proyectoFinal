<?php
    session_start();
    include '../class/conexion.php';
    $idEmpleado=$_SESSION['idEmpleado'];
    include '../class/vacaciones.php';
    $vacaciones = new vacaciones();
    if(isset($_POST['solicitudVa'])){
        $fechaInicial=$_POST['fechaInicial'];
        $fechaFinal=$_POST['fechaFinal'];
        $diff = abs(strtotime($fechaFinal) - strtotime($fechaInicial));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ 
                (60*60*24));
        $cantidad = $days+1;
        $fechaAct = date('Y-m-d');
        $diffEx = abs(strtotime($fechaInicial) - strtotime($fechaAct));
        $rango = floor(($diffEx - $years * 365*60*60*24 - $months*30*60*60*24)/ 
                 (60*60*24));
        $diasDisp = $_POST['cantidad'];
        if($rango >= 15){
            if($cantidad <= $diasDisp){
                $vacaciones->setFechaIni($fechaInicial);
                $vacaciones->setFechaFin($fechaFinal);
                $vacaciones->setCantidad($cantidad);
                $vacaciones->setEstado(1);
                $vacaciones->solicita($idEmpleado);
                echo '<script>location.href ="../vacaciones.php?message=save";'
                     . '</script>';
            }else{
                echo '<script>location.href ="../vacaciones.php?message=days";'
                     . '</script>';
            }
        }else{
            echo '<script>location.href ="../vacaciones.php?message=error";'
                 . '</script>';
        }
    }
?>

