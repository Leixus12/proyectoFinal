<?php
session_start();
$idEmpleado=$_SESSION['idEmpleado'];
include '../class/conexion.php';
include '../addons/config.php';
include '../class/nomina.php';
$nomina= new nomina();

if(isset($_SESSION['valido'])==1){
    $q = null;
    $pdo = new conexion();
    $query = $pdo ->prepare("SELECT idNomina, fechaInicial, fechaFinal, periodo,"
             . "DiasTrabajados FROM nomina WHERE idEmpleado = $idEmpleado;");
    $query->execute();
    $res = $query->fetchAll();
    $cont = 0;
$cuerpo = '<table border="1" id="nominas" class="table table-hover text-center"
          style="width: 100%;">
           <thead style="width: 100%;" class="thead-blue">
                <tr>
                    <th>ID Nomina</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Corte</th>
                    <th>Periodo</th>
                    <th>Dias Trabajados</th>
                    <th></th>
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
}

if(!isset($_GET['q'])){} else {
    $q=$_GET["q"];
}

if (strlen($q) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
    if (strtolower($q)==strtolower(substr($fechaIni[$i],0,strlen($q))) || 
        strtolower($q)==strtolower(substr($idNom[$i],0,strlen($q))) ){
      if ($hint==""){
        $hint=$cuerpo."<tr>"."<td>".$idNom[$i]."</td>"
                ."<td>".$fechaIni[$i]."</td>"
                ."<td>".$fechaFin[$i]."</td>"
                ."<td>".$perido[$i]."</td>".
                "<td>".$diasTrab[$i]."</td>"
                ."<td><a target='_blank' href='".
                $link."/ver_nomina.php?nom=".
                $idNom[$i]."' class='btn btn-success btn-lg'>Ver</a></td></tr>";
        echo '</tbody>';
        
        }else{
        $hint = $hint."<tr>"."<td>".$idNom[$i]."</td>"
                ."<td>".$fechaIni[$i]."</td>"
                ."<td>".$fechaFin[$i]."</td>"
                ."<td>".$perido[$i]."</td>"
                ."<td>".$diasTrab[$i]."</td>"
                ."<td><a target='_blank' href='".$link."/ver_nomina.php?nom="
                .$idNom[$i]."' class='btn btn-success btn-lg'>Ver</a></td></tr>";
        echo '</tbody>';
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
    $sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM "
                   . "nomina;");
    $sql_registe->execute();
    $result_register = $sql_registe->fetchColumn();
    $por_pagina = 10;
    $desde = ($pagina-1) * $por_pagina;
    $total_paginas = ceil($result_register / $por_pagina);
    echo $nomina->nominaE($idEmpleado, $pagina, $link);
  }

    if ($hint == ""){
          $response="<br>"."No hay coincidencias";
    }else{
      $response=$hint;
    }
    echo $response;
    }
?>