<?php
session_start();
include '../class/conexion.php';
include '../addons/config.php';
include '../class/empleado.php';
$empleado = new empleado();


/**
 * Filtro de empleados para poder consultar sus datos desde una tabla se muetra
 * el registro de todos y se realiza la paginacion para no saturar la pagina de
 * informacion
 */

if(isset($_SESSION['valido'])==1){
$q = null;
$pdo = new conexion();
$query = $pdo ->prepare("SELECT idEmpleado, nombre, apellidoPaterno, "
         . "apellidoMaterno, nombreUsuario, idPuesto FROM empleado WHERE "
         . "activoUsuario = '1' ORDER BY idEmpleado ASC;");
$query->execute();
$res = $query->fetchAll();
$cont = 0;
$cuerpo = '<table border="1" id="nominas" class="table table-hover text-center" 
          style="width: 100%;">
                <thead style="width: 100%;" class="thead-blue">
            <tr>
            <th style="width: 40%;">Nombre</th>
            <th style="width: 20%;">Usuario</th>
            <th style="width: 20%;">Puesto</th>
            <th style="width: 15%;">Acciones</th>
            <th style="width: 15%;"></th>
            </tr>
            </thead>
         <tbody style="width: 100%;">';

foreach ($res as $value) {
            $cont++;
            $idEmp[$cont]=$value['idEmpleado'];
            $nombreEmp[$cont]=$value['nombre'];
            $apellidoPa[$cont]=$value['apellidoPaterno'];
            $apellidoMa[$cont]=$value['apellidoMaterno'];
            $usuario[$cont]=$value['nombreUsuario'];
            $puesto[$cont]=$value['idPuesto'];
        }
        
for ($i = 1; $i <= $cont; $i++) {
            $query2 = $pdo ->prepare("SELECT nombrePuest FROM PUESTO WHERE "
                      . "idPuesto = $puesto[$i];");
            $query2->execute();
            $resT[$i]=$query2->fetchColumn();
        }

if(!isset($_GET['q'])){} else {
    $q=$_GET["q"];
}

if (strlen($q) > 0){
  $hint="";
  for($i=1; $i <= $cont ; $i++){
      $nombreCompleto[$i]=$apellidoPa[$i]." ".$apellidoMa[$i]." ".$nombreEmp[$i];
    if (strtolower($q)==strtolower(substr($usuario[$i],0,strlen($q))) || 
        strtolower($q)==strtolower(substr($nombreCompleto[$i],0,strlen($q)))  ){
      if ($hint==""){
        $hint = $cuerpo."<tr>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td>".$usuario[$i]."</td>".
                "<td>".$resT[$i]."</td>".
                "<td><a href='".$link.
                "/mod_usuario.php?user=".$idEmp[$i]
                ."' class='btn btn-success btn-lg' name='modNom'><img src='"
                . "$link/img/nav/icon38.png'> Editar</a></td>".
                "<td><a target='_blank' href='".$link."/drop_user.php?user=".
                $idEmp[$i]."' class='btn btn-danger btn-lg' name='dropNom'>"
                . "<img src='$link/img/nav/icon39.png'> Borrar</a></a></td>";
        $cuerpo.="</tr>";;
        echo '</tbody>';
        
        }else{
        $hint = $hint."<tr>".
                "<td>".$nombreCompleto[$i]."</td>".
                "<td>".$usuario[$i]."</td>".
                "<td>".$resT[$i]."</td>".
                "<td><a href='".$link."/mod_usuario.php?user=".$idEmp[$i]
                ."' class='btn btn-success btn-lg' name='modNom'><img src='"
                . "$link/img/nav/icon38.png'> Editar</a></td>".
                "<td><a target='_blank' href='".$link."/drop_user.php?user=".
                $idEmp[$i]."' class='btn btn-danger btn-lg' name='dropNom'>"
                . "<img src='$link/img/nav/icon39.png'> Borrar</a></a></td>";
        $cuerpo.="</tr>";
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
    $sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM"
                   . "empleado;");
    $sql_registe->execute();
    $result_register = $sql_registe->fetchColumn();
    $por_pagina = 10;
    $desde = ($pagina-1) * $por_pagina;
    $total_paginas = ceil($result_register / $por_pagina);
    echo $empleado->empleadoT($pagina, $link);
  }

if ($hint == ""){
      $response="<br>"."No hay coincidencias";
  }else{
      $response=$hint;
  }
  echo $response;
}
?>