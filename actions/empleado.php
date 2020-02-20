<?php
session_start();
include '../class/empleado.php';
include '../class/conexion.php';
$empleado = new empleado();

if(isset($_POST['actEmpleado'])){
    $empleado->setEmail($_POST['email']);
    $empleado->setDireccion($_POST['direccionE']);
    $empleado->setTelefono($_POST['telefonoE']);
    $empleado->actDatos($_SESSION['idEmpleado']);
    echo '<script>location.href ="../profile.php?message=save";</script>';
}elseif (isset ($_POST['actPassword'])){
    $passAct = md5($_POST['ppassword']);
    $passNew = md5($_POST['pnpass']);
    $passReNew = md5($_POST['pnrp']);
    
    $pdo= new conexion();
    $query = $pdo ->prepare("SELECT password from empleado where idEmpleado = "
             . $_SESSION['idEmpleado'].";");
    $query->execute();
    $res = $query->fetchColumn();
    if($res == $passAct){
        if($passNew == $passReNew){
            $query = $pdo->prepare("Update empleado set"
                    ." password = :password where idEmpleado = :idEmpleado;");
            $query->bindValue(":password", $passNew);
            $query->bindValue(":idEmpleado", $_SESSION['idEmpleado']);
            $query->execute();
            echo '<script>location.href ="../profile.php?tab=3&message=save";'
                . '</script>'; 
        }else{
           echo '<script>location.href ="../profile.php?tab=3&message=error_'
                . 'equals";</script>'; 
        }
    } else {
       echo '<script>location.href ="../profile.php?tab=3&message=error_pass";'
            . '</script>'; 
    }
}

?>

