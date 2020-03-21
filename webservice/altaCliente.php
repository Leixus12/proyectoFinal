<?php
include '../class/conexion.php';

    $con = new conexion();
    $query = $con->prepare("INSERT INTO cliente (nombre, apellido, fechaRegistro, email, telefono, usuario, contrasena) VALUES ("
            . "'".$_POST['n']."', "
            . "'".$_POST['ap']."', "
            . "'".date("y-m-d")."', "
            . "'".$_POST['e']."', "
            . "'".$_POST['t']."', "
            . "'".$_POST['u']."', "
            . "'".$_POST['p']."');");
    $query->execute();
?>
