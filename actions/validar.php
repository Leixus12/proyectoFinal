<?php
include_once '../class/conexion.php';
$pdo = new Conexion();
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

//variables que pasamos del formulario de IndexLogin
$vPass='p';
$vUser='u';
$pass=$_POST['pwd'];
$user=$_POST['user'];

//Conexion a base de datos

if($user=='' || $pass==''){header('location: ../index.php');}
else {
    try{
        $query = $pdo->prepare("select e.*, p.*, ed.*"
                . " from empleado e JOIN puesto p ON e.idpuesto = p.idPuesto"
                . " JOIN empleadodepartamento ed ON e.idEmpleado = ed.idEmpleado"
                ." JOIN departamento d on d.idDepart = ed.idDepart"
                . " WHERE e.nombreUsuario = :nombreUsuario and e.activoUsuario "
                . "= :activoUsuario;");
        $query->bindValue(':nombreUsuario', $user);
        $query->bindValue(':activoUsuario', '1');
        $query->execute();
        $resultado=$query->fetchAll();

        //Validacion y comparacion del usuario y contraseña
        foreach($resultado as $value){
            if($value["password"] == md5($pass)){
                $query = $pdo->prepare('UPDATE empleado set password = :password'
                         . ' where idEmpleado = :idEmpleado and activoUsuario '
                         . '= "1"');
                $query->bindValue(
                        ":password", password_hash($pass, PASSWORD_BCRYPT));
                $query->bindValue(":idEmpleado", $value["idEmpleado"]);
                $query->execute();
                $vPass='p'.$value['password'];
                $vUser='u'.$value['nombreUsuario'];
                $nombreUsuario=$value['nombre']." ".$value['apellidoPaterno'];
                $idEmpleado=$value['idEmpleado'];
                $puesto=$value['idPuesto'];
                $sucursal = $value['idSucursal'];
                $departamento = $value['idDepart'];
                $area = $value['nombrePuest'];
                
            }
            else if(password_verify($pass, $value["password"])){
                $vPass='p'.$value['password'];
                $vUser='u'.$value['nombreUsuario'];
                $nombreUsuario=$value['nombre'].$value['apellidoPaterno'];
                $idEmpleado=$value['idEmpleado'];
                $puesto=$value['idPuesto'];
                $sucursal = $value['idSucursal'];
                $departamento = $value['idDepart'];
                $area = $value['nombrePuest'];
            }
            
        }
        if($vUser=='u' && $vPass=='p'){
            echo '<script>alert("El usuario o contraseña son incorrectos. '
                 . 'Intente de nuevo.")</script>';
            echo '<script>location.href="../index.php"</script>';
        }else{
            $_SESSION['valido']=1;
            $_SESSION['idEmpleado']=$idEmpleado;
            $_SESSION['nombreUsuario']=$nombreUsuario;
            $_SESSION['idPuesto']=$puesto;
            $_SESSION['idSucursal']= $sucursal;
            $_SESSION['idDepart']=$departamento;
            
            if (isset($_SESSION['direccionURL'])) {
                echo "<script>location.href='".$_SESSION['direccionURL'].
                     "'</script>";
            }else{
                header('location: ../panel.php');
            }
        }

    }catch(PDOException $ex){
        echo 'Error: '.$ex->getMessage();
    }
    $pdo = null;

}
?>

