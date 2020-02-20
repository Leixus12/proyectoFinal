<?php
session_start();
include '../addons/config.php';
include '../class/conexion.php';
$tipoArchivo =".". substr($_FILES['FotoEMP']['type'], 6);

if(isset($_POST['GuardaFo'])){
    if($_FILES['FotoEMP']['error']>0){
        echo 'Error al cargar archivo';
    }else{
        $formato=array("image/png", "image/gif", "image/jpeg");
        $limite_kb = 2000;
        if(in_array($_FILES['FotoEMP']['type'], 
                    $formato) && $_FILES['FotoEMP']['size']<=$limite_kb * 1024){
            $ruta ='../img/profiles/';
            $nombreFoto=$_POST['nombreF'];
            $archivo= $ruta.$nombreFoto.$tipoArchivo;
            if(!file_exists($ruta)){
                mkdir($ruta);
            }
            if(!file_exists($archivo)){
                $sqlFoto = $link."/img/profiles/".$nombreFoto.$tipoArchivo;
                $idEmpleado=$_SESSION['idEmpleado'];
                $resultado = @move_uploaded_file($_FILES['FotoEMP']['tmp_name'],
                        $archivo);
                $pdo = new conexion();
                $query = $pdo->prepare("UPDATE empleado"
                        ." SET foto = :foto"
                        ." WHERE idEmpleado = :idEmpleado;");
                $query->bindValue(":foto", $sqlFoto);
                $query->bindValue(":idEmpleado", $idEmpleado);
                $query->execute();
                if($resultado){
                    echo '<script>location.href ="../profile.php?tab=2&message='
                         . 'save_photo";</script>';  
                }else{
                }
            }else{
                echo 'Archivo ya existente';
            }
        } else {
           echo '<script>location.href ="../profile.php?tab=2&message='
                . 'error_size";</script>';
        }
    }
}

?>

