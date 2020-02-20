<?php
session_start();
$idEmpleado=$_SESSION['idEmpleado'];
include '../class/conexion.php';
include '../addons/config.php';
include '../class/asistencia.php';
$asistencia = new asistencia();

if(isset($_SESSION['valido'])==1){
    
if(!isset($_GET['q'])){
    $q="";
} else {
    $q=$_GET["q"];
}
if(!isset($_GET['f'])){
    $f="";
} else {
    $f=$_GET["f"];
}
 
$pdo = new conexion();
if(!empty($f) && !empty($q) ){
    $query = $pdo ->prepare("SELECT a.idAsistencia, a.Fecha, a.HoraEntrada, "
            . "a.HoraSalida, e.nombre, e.apellidoPaterno, e.apellidoMaterno "
            . "FROM asistencia a join empleado e on a.idEmpleado = e.idEmpleado"
            . " WHERE a.Fecha = '$f' ORDER BY a.idAsistencia DESC;");
}else{
    $query = $pdo ->prepare("SELECT a.idAsistencia, a.Fecha, a.HoraEntrada,"
            . "a.HoraSalida, e.nombre, e.apellidoPaterno, e.apellidoMaterno "
            . "FROM asistencia a join empleado e on a.idEmpleado = e.idEmpleado"
            . " ORDER BY a.idAsistencia DESC;");
}
$query->execute();
$res = $query->fetchAll();
$cont = 0;
$cuerpo='<table border="1" id="nominas" class="table table-hover text-center"
    style="width: 100%;">
            <thead style="width: 100%;" class="thead-blue">
                <tr>
                                <th style="width: 10%">Fecha</th>
                                    <th style="width: 5%">Entrada</th>
                                    <th style="width: 5%">Salida</th>
                                    <th style="width: 20%">Nombre</th>
                                    <th style="width: 10%">Acciones</th>
                            </tr>
            </thead>
         <tbody style="width: 100%;">';

foreach ($res as $value) {
    $cont++;
    $idAsis[$cont]=$value['idAsistencia'];
    $fecha[$cont]=$value['Fecha'];
    $horaEntrada[$cont]=$value['HoraEntrada'];
    $horaSalida[$cont]=$value['HoraSalida'];
    $nom[$cont]=$value['nombre'];
    $apellidoP[$cont]=$value['apellidoPaterno'];
    $apellidoM[$cont]=$value['apellidoMaterno'];
}

if (strlen($q) > 0 && strlen($f) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
   $nombreCompleto[$i]= $apellidoP[$i]." ".$apellidoM[$i]." ".$nom[$i];
   if(!empty($q) && !empty($f)){
    if (strtolower($q)==strtolower(substr($nombreCompleto[$i],0,strlen($q))) ){
      
      if (empty($hint)){
        $hint=$cuerpo."<tr>".
                "<td>".$fecha[$i]."</td>".
                "<td>".$horaEntrada[$i]."</td>".
                "<td>".$horaSalida[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a href='".$link."/mod_asistencia"
                . ".php?asis=".$idAsis[$i]."' "
                . "class='btn btn-success btn-lg' "
                . "name='modNom'><img src='"
                . "$link/img/nav/icon38.png'> "
                . "Editar</a></td></tr>";
        echo '</tbody>';
                            
                            
        
        }else{
        $hint = $hint."<tr>".
                "<td>".$fecha[$i]."</td>".
                "<td>".$horaEntrada[$i]."</td>".
                "<td>".$horaSalida[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a href='".$link."/mod_nomina.php?nom=".$idAsis[$i]
                ."' class='btn btn-success btn-lg' name='modNom'><img src='"
                . "$link/img/nav/icon38.png'> Editar</a></td></tr>";
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
    if (strtolower($q)==strtolower(substr($nombreCompleto[$i],0,strlen($q))) ){
      
      if ($hint==""){
        $hint = $cuerpo."<tr>".
                "<td>".$fecha[$i]."</td>".
                "<td>".$horaEntrada[$i]."</td>".
                "<td>".$horaSalida[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a href='".$link."/mod_asistencia."
                . "php?asis=".$idAsis[$i]."' class='btn "
                . "btn-success btn-lg' name='modNom'><img src='"
                . "$link/img/nav/icon38.png'> Editar</a></td></tr>";
        echo '</tbody>';
        
        }else{
        $hint = $hint."<tr>".
                "<td>".$fecha[$i]."</td>".
                "<td>".$horaEntrada[$i]."</td>".
                "<td>".$horaSalida[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a href='".$link."/mod_nomina.php?nom=".$idAsis[$i] . 
                "' class='btn btn-success btn-lg' name='modNom'><img src='"
                . "$link/img/nav/icon38.png'> Editar</a></td></tr>";
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
    if (strtolower($f)==strtolower(substr($fecha[$i],0,strlen($f))) ){
      
      if ($hint==""){
            $hint = $cuerpo."<tr>".
                    "<td>".$fecha[$i]."</td>".
                    "<td>".$horaEntrada[$i]."</td>".
                    "<td>".$horaSalida[$i]."</td>".
                    "<td>".$nombreCompleto[$i]."</td>".
                    "<td><a href='".$link."/mod_asistencia.php?asis=" . 
                    $idAsis[$i]."' class='btn btn-success btn-lg' name='modNom'>"
                    . "<img src='$link/img/nav/icon38.png'> Editar</a>"
                    . "</td></tr>";
            echo '</tbody>';
        
        }else{
            $hint = $hint . "<tr>".
                        "<td>".$fecha[$i]."</td>".
                        "<td>".$horaEntrada[$i]."</td>".
                        "<td>".$horaSalida[$i]."</td>".
                        "<td>".$nombreCompleto[$i]."</td>".
                        "<td><a href='".$link."/mod_nomina.php?nom=".$idAsis[$i]
                        . "' class='btn btn-success btn-lg' name='modNom'>"
                        . "<img src='"
                        . "$link/img/nav/icon38.png'> Editar</a></td></tr>";
            echo '</tbody>';
        }
      }
    }
    }
  }
  else{
      $hint = $cuerpo;
        if(isset($_GET['pagina'])){
            $pagina = $_GET['pagina'];
        }else{
            $pagina = 1;
	}
    $pdo = new conexion();
    $sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM "
                   . "asistencia;");
    $sql_registe->execute();
    $result_register = $sql_registe->fetchColumn();
    $por_pagina = 10;
    $desde = ($pagina-1) * $por_pagina;
    $total_paginas = ceil($result_register / $por_pagina);
    echo $asistencia->asistenciaT($pagina, $link);
  }
 
  if (empty($hint)){
        $response="<br>"."No hay coincidencias";
  }else{
    $response=$hint;
  }
    echo $response;
}

?>