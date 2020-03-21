<?php

include '../class/conexion.php';
$con = new conexion();
$cliente = Array();


if(isset($_GET['p'])){
    $contra = $_GET['p'];
    $query = $con->prepare("SELECT * FROM cliente WHERE contrasena = '$contra';");
    $query->execute();
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
      $row['contrasena']="";
      $cliente['cliente'][] = $row;
    }
    echo json_encode($cliente);
}else{
    /*
    $query = $con->prepare("select * from paises;");
    $query->execute();
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
      $paises['AllContry'][] = $row;
    }
    echo json_encode($paises);*/
}

?>

