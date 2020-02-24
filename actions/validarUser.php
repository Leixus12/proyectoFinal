<?php


include '../class/conexion.php';
$nombre = $_GET['q'];

/**
 * mantiene los datos actualizados del empleado en tiempo real y si el usuario
 * tiene permisos de administrador
 */

$pdo = new conexion();
$query = $pdo ->prepare("SELECT nombreUsuario FROM empleado WHERE nombreUsuario"
         . " LIKE 'Admin';");
$query->execute();
$res = $query->fetchColumn();

if($nombre == $res ){
    echo '<span id="userExit" '
    . 'class="text-danger"> Este usuario ya esta en uso</span>';
}

?>
