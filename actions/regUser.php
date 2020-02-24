<?php

 include '../class/conexion.php';
 include '../class/empleado.php';
 include '../addons/config.php';
 $empleado = new empleado();

 
 /**
  * Validacion del formulario del panel de administracion para registro de 
  * nuevos empleados.
  * 
  */
if (isset($_POST['okEmp'])){
    $empleado->setNombre($_POST['nomEmp']);
    $empleado->setApellidoPaterno($_POST['nomEmpP']);
    $empleado->setApellidoMaterno($_POST['nomEmpM']);
    $empleado->setDireccion($_POST['direcEmp']);
    $empleado->setTelefono($_POST['telEmp']);
    $empleado->setFechaNacimiento($_POST['fechaEmpNa']);
    $empleado->setEmail($_POST['emailEmp']);
    $empleado->setCurp($_POST['curpEmp']);
    $empleado->setRfc($_POST['rfcEmp']);
    $empleado->setNss($_POST['nssEmp']);
    $empleado->setIdSucursal($_POST['sucEmp']);
    $empleado->setIdPuesto($_POST['areaEmp']);
    $empleado->setIdTurno($_POST['turnoEmp']);
    $empleado->setIdImss($_POST['claseImss']);
    $empleado->setNombreUsuario($_POST['userEmp']);
    $empleado->setPassword(md5($_POST['passEmp']));
    $empleado->setFechaIngreso(date("Y-m-d"));
    $empleado->setIdDepart($_POST['idDepart']);
    $empleado->altaUsuario();
    echo '<script>location.href ="'.$link.'/buscarEmpleado.php?message=save";'
         . '</script>';
}

?>
