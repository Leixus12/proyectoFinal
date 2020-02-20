<?php
    include '../class/conexion.php';
    $area=$_GET['a'];
    if(!isset($_GET['t'])){}else{
        $puesto=$_GET['t'];
    }
    $pdo = new conexion();
    if(isset($_GET['a']) > 0 && isset($_GET['t']) > 0){
        $query = $pdo ->prepare("SELECT * FROM empleado where idPuesto=".
                 $area." and idTurno= ".$puesto.";");
        $query->execute();
    }
    if($_GET['a'] > 0 && !isset ($_GET['t'])){
        $query = $pdo ->prepare("SELECT * FROM empleado where idPuesto=".
                 $area.";");
        $query->execute();
    }
    $res = $query->fetchAll();
    $cont=0;
    foreach ($res as $value) {
        $cont++;
        $idEmpleado[$cont]=$value['idEmpleado'];
        $nombre[$cont]=$value['nombre'];
        $apellidoPaterno[$cont]=$value['apellidoPaterno'];
    }
    echo '<select class="form-control" name="idEmpleado">';
    echo '<option value="0" selected disabled>Secciona uno...</option>';
    for($i = 1 ; $i <= $cont; $i++){
        echo '<option value="'.$idEmpleado[$i].'" >'.$nombre[$i].' '.
             $apellidoPaterno[$i].'</option>';
    }
    echo '</select>';
?>
