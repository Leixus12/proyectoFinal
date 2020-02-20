<?php


include '../class/conexion.php';


$nombre = $_GET['q'];


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
