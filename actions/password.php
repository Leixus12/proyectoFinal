<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../src/Exception.php';
include '../src/PHPMailer.php';
include '../src/SMTP.php';
include '../addons/config.php';
include '../class/conexion.php';
include '../class/password.php';

if(isset($_POST['passNew'])){
$pass = new password();
$randomS = $random_string = chr(rand(65,90)) . chr(rand(65,90)) . 
           chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
$randomN = $random_number = intval( "0" . rand(1,9) . rand(0,9) . 
           rand(0,9) . rand(0,9) . rand(0,9) );
$randomN2 = $random_number = intval( "0" . rand(1,9) . rand(0,9) );
$randomS2 = $random_string = chr(rand(65,90)) . chr(rand(65,90)) . 
            chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
$code = $randomS.$randomN.$randomS2.$randomN2;
if(!isset($_POST['email'])){
    $destino = "";
}else{
    $destino = $_POST['email'];
}

$pdo= new conexion;
$query = $pdo->prepare("SELECT idEmpleado FROM empleado WHERE email='".
         $destino."';");
$query->execute();
$res = $query->fetchColumn();
$tiempoC= time();
$tiempoE=$tiempoC+(60*15);
$pass->setCodigo($code);
$pass->setTiempoCreacion($tiempoC);
$pass->setTiempoExpiracion($tiempoE);
$pass->setEstado(0);
$pass->setIdEmpleado($res);
$pass->inserCode();


if($res == null){
}else{
    $nombreAu = 'Clinica Santa Barbara';
    $asunto = '[Clinica Santa Barbara]: instrucciones para cambiar tu contrasena';
    $mensaje =  '<p>Ha solicitado restablecer su contrase&ntilde;a para la '
                . 'cuenta de Cl&iacute;nica Santa B&aacute;rbara asociada con '
                . 'esta direcci&oacute;n de correo electr&oacute;nico ('.
                $destino.'). Para obtener el c&oacute;digo de 
                restablecimiento de contrase&ntilde;a, haga clic en el siguiente
                enlace:</p>
                <a href="'.$link.'/forgot.php?pass='.$code.'">'.$link.
                '/forgot.php?pass='.$code.'</a>
                <p>Tambi&eacute;n puede copiar y pegar el enlace anterior en 
                una nueva ventana del navegado</p>
                <p>'.'</p>
                <p> Este c&oacute;digo de cambio de contrase&ntilde;a 
                caducar&aacute; en <b>15 Minutos</b> despu&eacute;s de la hora 
                de env&iacute;o del este correo electr&oacute;nico. Para 
                reiniciar el proceso de cambio de contrase&ntilde;a, haga clic 
                aqu&iacute;:</p>
                <p>'.$link.'/forgot.php'.'</p>
                <p>Si no hizo la solicitud, puede ignorar este correo 
                electr&oacute;nico y no hacer nada. Es probable que otro 
                usuario haya ingresado su direcci&oacute;n de correo 
                electr&oacute;nico por error al intentar restablecer una 
                contrase&ntilde;a.</p>
                <p> Las respuestas a este correo electr&oacute;nico no son 
                monitoreadas o contestadas.</p>';
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.ionos.mx';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'help@leixus.org';
    $mail->Password   = 'Uzba6498?';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('help@leixus.org', $nombreAu);
    $mail->addAddress($destino);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body    = $mensaje;

    $mail->send();
    if ($mail->send()){
        echo 'mensaje enviado';
        echo '<script>location.href ="../index.php?message=save";</script>';
    }else{
        echo 'mensaja no enviado';
    }
    
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
}

if(isset ($_POST['passCode'])){
    $passNew= md5($_POST['passNew']);
    $passNEwRe= md5($_POST['passNewRe']);
    $code = $_POST['codeRe'];
    $pdo = new conexion();
    $query = $pdo ->prepare("SELECT * from password where codigo='".$code
             ."' AND estado='0';");
    $query->execute();
    $res = $query->fetchAll();
    $tiempoAct = time();
    foreach ($res as $value) {
        $codigo=$value['codigo'];
        $tiempoExpiracion=$value['timeEnd'];
        $estado=$value['estado'];
        $idEmpleado = $value['idEmpleado'];
    }
    if($tiempoAct<=$tiempoExpiracion){
        if($estado=='0'){
            if($passNew == $passNEwRe){
                $query= $pdo->prepare("UPDATE empleado set password = "
                        . ":password where idEmpleado = :idEmpleado;");
                $query2= $pdo->prepare("UPDATE password set estado='1' "
                         . "where codigo= '".$codigo."';");
                $query->bindValue(":password",$passNew);
                $query->bindValue(":idEmpleado", $idEmpleado);
                $query->execute();
                $query2->execute();
                echo '<script>location.href ="'.$link.
                     '/index.php?message=change_password";</script>';
                $pdo=null;
            }else{
                 echo '<script>location.href ="'.$link.
                      '/forgot.php?message=password";</script>';
            }
            
        } else {
             echo '<script>location.href ="'.$link
                  .'/forgot.php?message=code";</script>';
        }
    }else{
         echo '<script>location.href ="'.
              $link.'/forgot.php?message=time";</script>';
    }
}?>