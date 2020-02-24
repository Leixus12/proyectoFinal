<?php
session_start();
$idEmpleado=$_SESSION['idEmpleado'];
include '../class/conexion.php';
include '../addons/config.php';
include '../class/nomina.php';
$nomina = new nomina();


/**
 * Se hace usa de Ajax para modificar las varibales e y p
 * mediante una paginacion de elementos delimitados para evitar la sobre carga
 * de informacion en web esto es para el panel de administracion, aparecen todas
 * las nominas generadas.
 */
if(isset($_SESSION['valido'])==1){
    
if(!isset($_GET['e'])){
    $e = ""; //empleado
} else {
    $e = $_GET["e"];
}
if(!isset($_GET['p'])){
    $p = ""; //periodo
} else {
    $p = $_GET["p"];
}
 
$pdo = new conexion();
if(!empty($p) && empty($e) ){
    $euery = $pdo ->prepare("SELECT n.idNomina, n.fechaInicial, n.fechaFinal, "
             . "n.periodo, n.DiasTrabajados, e.nombre, e.apellidoPaterno, "
             . "e.apellidoMaterno FROM nomina n JOIN empleado e on e.idEmpleado"
             . " = n.idEmpleado; WHERE periodo = $p;");
}else{
    $euery = $pdo ->prepare("SELECT n.idNomina, n.fechaInicial, n.fechaFinal, "
             . "n.periodo, n.DiasTrabajados, e.nombre, e.apellidoPaterno, "
             . "e.apellidoMaterno FROM nomina n JOIN empleado e on e.idEmpleado"
             . " = n.idEmpleado;");
}
$euery->execute();
$res = $euery->fetchAll();
$cont = 0;
$cuerpo = '<table border="1" id="nominas" class="table table-hover text-center" 
          style="width: 100%;">
            <thead style="width: 100%;" class="thead-blue">
                <tr>
                    <th style="width:20%">N° Nómina</th>
                    <th style="width:15%">Fecha de Inicio</th>
                    <th style="width:15%">Fecha de Corte</th>
                    <th style="width:2%">Periodo</th>
                    <th style="width:20%">Días Trabajados</th>
                    <th style="width:50%">Empleado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
         <tbody style="width: 100%;">';

foreach ($res as $value) {
    $cont++;
    $idNom[$cont]=$value['idNomina'];
    $fechaIni[$cont]=$value['fechaInicial'];
    $fechaFin[$cont]=$value['fechaFinal'];
    $perido[$cont]=$value['periodo'];
    $diasTrab[$cont]=$value['DiasTrabajados'];
    $nom[$cont]=$value['nombre'];
    $apellidoP[$cont]=$value['apellidoPaterno'];
    $apellidoM[$cont]=$value['apellidoMaterno'];
}

if (strlen($e) > 0 && strlen($p) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
   $nombreCompleto[$i]= $apellidoP[$i]." ".$apellidoM[$i]." ".$nom[$i];
   if(!empty($e) && !empty($p)){
    if (strtolower($e)==strtolower(substr($nombreCompleto[$i],0,strlen($e))) ){
      
      if (empty($hint)){
        $hint = $cuerpo."<tr>".
                "<td>".$idNom[$i]."</td>".
                "<td>".$fechaIni[$i]."</td>".
                "<td>".$fechaFin[$i]."</td>".
                "<td>".$perido[$i]."</td>".
                "<td>".$diasTrab[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a target='_blank' href='".$link
                ."/ver_nomina.php?nom=".$idNom[$i]
                ."' class='btn btn-success btn-lg' "
                . "name='verNom'> <img src='"
                . "$link/img/nav/icon40.png'>"
                . "Ver</a></td>";
        echo '</tbody>';
        }else{
        $hint = $hint."<tr>".
                "<td>".$idNom[$i]."</td>".
                "<td>".$fechaIni[$i]."</td>".
                "<td>".$fechaFin[$i]."</td>".
                "<td>".$perido[$i]."</td>".
                "<td>".$diasTrab[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a target='_blank' href='".
                $link."/ver_nomina.php?nom=".
                $idNom[$i]."' class='btn btn-success btn-lg' name='verNom'>"
                . "<img src='$link/img/nav/icon40.png'> Ver</a></td>";
                            echo '</tbody>';
        }
      }
    }
      
      
      
    }
  }elseif (strlen($e) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
   $nombreCompleto[$i]= $apellidoP[$i]." ".$apellidoM[$i]." ".$nom[$i];
   if(!empty($e) && empty($p)){
    if (strtolower($e)==strtolower(substr($nombreCompleto[$i],0,strlen($e))) ){
      
      if ($hint == ""){
        $hint = $cuerpo."<tr>".
                "<td>".$idNom[$i]."</td>".
                "<td>".$fechaIni[$i]."</td>".
                "<td>".$fechaFin[$i]."</td>".
                "<td>".$perido[$i]."</td>".
                "<td>".$diasTrab[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a target='_blank' href='".$link.
                "/ver_nomina.php?nom=".$idNom[$i].
                "' class='btn btn-success btn-lg' name='verNom'> <img src='"
                . "$link/img/nav/icon40.png'> Ver</a></td>";
        echo '</tbody>';
        }else{
        $hint = $hint."<tr>".
                "<td>".$idNom[$i]."</td>".
                "<td>".$fechaIni[$i]."</td>".
                "<td>".$fechaFin[$i]."</td>".
                "<td>".$perido[$i]."</td>".
                "<td>".$diasTrab[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a target='_blank' href='".
                $link."/ver_nomina.php?nom=".
                $idNom[$i]."' class='btn btn-success btn-lg' name='verNom'>"
                . "<img src='$link/img/nav/icon40.png'> Ver</a></td>";
        echo '</tbody>';
        }
      }
    }
    }
  }elseif (strlen($p) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
   $nombreCompleto[$i]= $apellidoP[$i]." ".$apellidoM[$i]." ".$nom[$i];
   if(empty($e) && !empty($p)){
    if (strtolower($p)==strtolower(substr($perido[$i],0,strlen($p))) ){
      
      if ($hint==""){
        $hint = $cuerpo."<tr>".
                "<td>".$idNom[$i]."</td>".
                "<td>".$fechaIni[$i]."</td>".
                "<td>".$fechaFin[$i]."</td>".
                "<td>".$perido[$i]."</td>".
                "<td>".$diasTrab[$i]."</td>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td><a target='_blank' href='"
                .$link."/ver_nomina.php?nom=".
                $idNom[$i]."' class='btn btn-success btn-lg' name='verNom'>"
                . "<img src='$link/img/nav/icon40.png'> Ver</a></td>";
        echo '</tbody>';
        }else{
        $hint = $hint."<tr>".
            "<td>".$idNom[$i]."</td>".
            "<td>".$fechaIni[$i]."</td>".
            "<td>".$fechaFin[$i]."</td>".
            "<td>".$perido[$i]."</td>".
            "<td>".$diasTrab[$i]."</td>".
            "<td>".$nombreCompleto[$i]."</td>".
            "<td><a target='_blank' href='".
            $link."/ver_nomina.php?nom=".$idNom[$i].
            "' class='btn btn-success btn-lg' name='verNom'>"
            . "<img src='$link/img/nav/icon40.png'> Ver</a></td>";
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
    $sql_registe = $pdo->prepare("SELECT COUNT(*) as"
                   . "total_registro FROM asistencia;");
    $sql_registe->execute();
    $result_register = $sql_registe->fetchColumn();
    $por_pagina = 10;
    $desde = ($pagina-1) * $por_pagina;
    $total_paginas = ceil($result_register / $por_pagina);
    echo $nomina->nominaT($pagina, $link);
    }
 
if (empty($hint)){
            $response="<br>"."No hay coincidencias";
  }else{
  $response=$hint;
  }
    echo $response;
}

?>