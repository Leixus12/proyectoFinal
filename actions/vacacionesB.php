
<?php

session_start();
include '../class/conexion.php';
include '../addons/config.php';
include '../class/vacaciones.php';


/**
 * Se hace usa de Ajax para modificar las varibales q y f
 * mediante una paginacion de elementos delimitados para evitar la sobre carga
 * de informacion en web esto es para el panel de administracion, aparecen todas
 * las peticiones de vacaciones.
 */

$vacaciones = new vacaciones();

 if(isset($_SESSION['valido'])==1){
    if(!isset($_GET['q'])){
        $q=""; //Nombre del empleado
    } else {
        $q=$_GET["q"]; //Nombre del empleado
    }
    if(!isset($_GET['f'])){
        $f=""; // estado
    } else {
        $f=$_GET["f"]; // estado
 }
$pdo = new conexion();
if(!empty($f) && empty($q) ){
    $query = $pdo ->prepare("SELECT v.idVacation, v.FechaInicial, v.FechaFinal,"
             . " v.Estado, e.nombre, e.apellidoPaterno, e.apellidoMaterno FROM "
            . " vacaciones v join empleado e on v.idEmpleado = e.idEmpleado "
            . " WHERE Estado='$f' ORDER BY v.idVacation DESC;");
}elseif(!empty($f) && !empty($q) ){
    $query = $pdo ->prepare("SELECT v.idVacation, v.FechaInicial, v.FechaFinal,"
             . "v.Estado, e.nombre, e.apellidoPaterno, e.apellidoMaterno FROM "
            . "vacaciones v join empleado e on v.idEmpleado = e.idEmpleado WHERE"
            . " Estado='$f' ORDER BY v.idVacation DESC;");
}else{
    $query = $pdo ->prepare("SELECT v.idVacation, v.FechaInicial, v.FechaFinal,"
             . " v.Estado, e.nombre, e.apellidoPaterno, e.apellidoMaterno FROM"
             . " vacaciones v join empleado e on v.idEmpleado = e.idEmpleado "
             . "ORDER BY v.idVacation DESC;");
}
$query->execute();
$res = $query->fetchAll();
$cont = 0;
$cuerpo = '<table border="1" id="nominas" class="table table-hover text-center" 
            style="width: 100%;">
            <thead style="width: 100%;" class="thead-blue">
                <tr>
                    <th style="width: 10%">Fecha Inicio</th>
                    <th style="width: 5%">Fecha Final</th>
                    <th style="width: 5%">Estatus</th>
                    <th style="width: 20%">Nombre</th>
                    <th style="width: 10%">Acciones</th>
                </tr>
            </thead>
         <tbody style="width: 100%;">';

foreach ($res as $value) {
    $cont++;
    $idVacacion[$cont]=$value['idVacation'];
    $fechaIni[$cont]=$value['FechaInicial'];
    $fechaFin[$cont]=$value['FechaFinal'];
    $Estado[$cont]=$value['Estado'];
    $nom[$cont]=$value['nombre'];
    $apellidoP[$cont]=$value['apellidoPaterno'];
    $apellidoM[$cont]=$value['apellidoMaterno'];
}

if (strlen($q) > 0 && strlen($f) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
   $nombreCompleto[$i]= $apellidoP[$i]." ".$apellidoM[$i]." ".$nom[$i];
   if(!empty($q) && !empty($f)){
       if($Estado[$i] == 1){
           $nomEstado='PROCESO';
           $valueEstado=1;
           $htmlVacaciones="<td class='proceso'>PROCESO</td>";
       }elseif($Estado[$i] == 2){
           $nomEstado='ACEPTADA';
           $valueEstado=2;
           $htmlVacaciones="<td class='aprovada'>APROBADA</td>";
       }elseif($Estado[$i] == 3){
           $nomEstado='CANDELADA';
           $valueEstado=3;
           $htmlVacaciones="<td class='cancelada'>CANCELADA</td>";
       }
    if (strtolower($q)==strtolower(substr($nombreCompleto[$i],0,strlen($q))) ){
      
      if (empty($hint)){
        $hint = $cuerpo."<tr>".
                "<td>".$fechaIni[$i]."</td>".
                "<td>".$fechaFin[$i]."</td>".
                $htmlVacaciones.
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a href='".$link."/mod_asistencia.php?asis=".
                $idVacacion[$i]."' class='btn btn-success btn-lg' "
                . "name='modNom'>"
                . "<img src='$link/img/nav/icon38.png'> Editar</a></td></tr>";
        echo '</tbody>';
        }else{
            $hint = $hint."<tr>".
                    "<td>".$fechaIni[$i]."</td>".
                    "<td>".$fechaFin[$i]."</td>".
                    $htmlVacaciones.
                    "<td>".$nombreCompleto[$i]."</td>".
                    "<td><a href='".$link."/mod_asistencia.php?asis=".
                    $idVacacion[$i]."' class='btn btn-success btn-lg' "
                    . "name='modNom'><img src='$link/img/nav/icon38.png'> "
                    . "Editar</a></td></tr>";
            echo '</tbody>';
        }
      }
    }
    }
  }elseif (strlen($q) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
   $nombreCompleto[$i]= $apellidoP[$i]." ".$apellidoM[$i]." ".$nom[$i];
   if(!empty($q) && empty($f)){
       if($Estado[$i] == 1){
           $nomEstado='PROCESO';
           $valueEstado=1;
           $htmlVacaciones="<td class='proceso'>PROCESO</td>";
       }elseif($Estado[$i] == 2){
           $nomEstado='ACEPTADA';
           $valueEstado=2;
           $htmlVacaciones="<td class='aprovada'>APROBADA</td>";
       }elseif($Estado[$i] == 3){
           $nomEstado='CANDELADA';
           $valueEstado=3;
           $htmlVacaciones="<td class='cancelada'>CANCELADA</td>";
       }
    if (strtolower($q)==strtolower(substr($nombreCompleto[$i],0,strlen($q))) ){
      
      if ($hint==""){
            $hint = $cuerpo."<tr>".
                    "<td>".$fechaIni[$i]."</td>".
                    "<td>".$fechaFin[$i]."</td>".
                    $htmlVacaciones.
                    "<td>".$nombreCompleto[$i]."</td>".
                    "<td><a href='".$link."/mod_vacaciones.php?asis=".
                    $idVacacion[$i]."' class='btn btn-success btn-lg' "
                    . "name='modNom'><img src='$link/img/nav/icon38.png'>"
                    . "Editar</a></td></tr>";
            echo '</tbody>';
        
        }else{
        $hint = $hint."<tr>".
                "<td>".$fechaIni[$i]."</td>".
                "<td>".$fechaFin[$i]."</td>".
                $htmlVacaciones.
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a href='".$link."/mod_vacaciones.php?asis=".
                $idVacacion[$i]."' class='btn btn-success btn-lg' "
                . "name='modNom'><img src='$link/img/nav/icon38.png'>"
                . "Editar</a></td></tr>";
        echo '</tbody>';
        }
      }
    }
    }
  }elseif (strlen($f) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
   $nombreCompleto[$i]= $apellidoP[$i]." ".$apellidoM[$i]." ".$nom[$i];
   if(empty($q) && !empty($f)){
           $nomEstado[$i]="";
           $valueEstado[$i]=0;
           
        if($Estado[$i] == 1){
           $nomEstado[$i]='PROCESO';
           $valueEstado[$i]=1;
           $htmlVacaciones="<td class='proceso'>PROCESO</td>";
       }elseif($Estado[$i] == 2){
           $nomEstado[$i]='ACEPTADA';
           $valueEstado[$i]=2;
           $htmlVacaciones[$i]="<td class='aprovada'>APROBADA</td>";
       }elseif($Estado[$i] == 3){
           $nomEstado[$i]='CANDELADA';
           $valueEstado[$i]=3;
           $htmlVacaciones[$i]="<td class='cancelada'>CANCELADA</td>";
       }
    if (strtolower($f)==strtolower(substr($valueEstado[$i],0,strlen($f))) ){
      
      if ( $hint == "" ){
            $hint = $cuerpo."<tr>".
                    "<td>".$fechaIni[$i]."</td>".
                    "<td>".$fechaFin[$i]."</td>".
                    $htmlVacaciones.
                    "<td>".$nombreCompleto[$i]."</td>".
                    "<td><a href='".$link."/mod_asistencia.php?asis=".
                    $idVacacion[$i]."' class='btn btn-success btn-lg' "
                    . "name='modNom'><img src='$link/img/nav/icon38.png'> "
                    . "Editar</a></td></tr>";
            echo '</tbody>';
        }else{
        $hint = $hint."<tr>".
                "<td>".$fechaIni[$i]."</td>".
                "<td>".$fechaFin[$i]."</td>".
                $htmlVacaciones.
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a href='".$link."/mod_asistencia.php?asis=".
                $idVacacion[$i]."' class='btn btn-success btn-lg' "
                . "name='modNom'><img src='$link/img/nav/icon38.png'> "
                . "Editar</a></td></tr>";
        echo '</tbody>';
        }
      }
    }
    }
  }else{
      $hint = $cuerpo;
      if(isset($_GET['pagina'])){
            $pagina = $_GET['pagina'];
        }else{
            $pagina = 1;
        }
        $pdo = new conexion();
	$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro "
                       . "FROM vacaciones;");
        $sql_registe->execute();
	$result_register = $sql_registe->fetchColumn();
	$por_pagina = 10;
	$desde = ($pagina-1) * $por_pagina;
    $total_paginas = ceil($result_register / $por_pagina);
    echo $vacaciones->vacacionesT($pagina, $link);
  }
 
if (empty($hint)){
            $response="<br>"."No hay coincidencias";
  }else{
  $response=$hint;
  }
    echo $response;
}

?>