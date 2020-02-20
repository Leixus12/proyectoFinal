<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../class/conexion.php';
include '../addons/config.php';
include '../class/nomina.php';
include '../src/Exception.php';
include '../src/PHPMailer.php';
include '../src/SMTP.php';

session_start();
include('../qr/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;
include '../vendor/autoload.php';
include '../class/empleado.php';
include '../class/deducciones.php';
include '../class/percepciones.php';
include '../class/asistencia.php';
include '../class/turno.php';
include '../class/puesto.php';

$nomina2 = new nomina();

if($_SESSION['valido']==1 && $_SESSION['idPuesto']== 1 || $_SESSION['idPuesto'] 
    == 6 ){
    $randomS = $random_string = chr(rand(65,90)) . chr(rand(65,90)) . 
               chr(rand(65,90)) . chr(rand(65,90));
    $randomS2 = $random_string = chr(rand(65,90)) . 
               chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
    $randomN = $random_number = intval( "0" . rand(1,9) . rand(1,9)
               . rand(1,9) . rand(1,9));
    $randomN2 = $random_number = intval( "0" . rand(1,9) . rand(1,9) . 
                rand(1,9) . rand(1,9));
    if(isset($_POST['crearNomina'])){
        $fechaIni = $_POST['fechaIni'];
        $fechaFin = $_POST['fechaFin'];
        $pdo = new conexion();
        $query = $pdo->prepare("SELECT COUNT(*) FROM empleado;");
        $query->execute();
        $res = $query->fetchColumn();
        
        for ($i = 1; $i <= $res; $i++) {
            $id[$i]=$randomN.$randomS.$randomN2.$randomS2.$i;
            $query2 = $pdo->prepare("SELECT * FROM `nomina` WHERE fechaInicial='"
                      .$fechaIni."' AND fechaFinal='".$fechaFin.
                      "' AND idEmpleado=".$i.";");
            $query2->execute();
            $res2= $query2->fetchAll();
            $nomina2->crearNom($id[$i], $fechaIni, $fechaFin, $i);

            //Datos por empleado
            $asistencia[$i] = new asistencia();
            $percepciones[$i] = new percepciones();
            $deducciones[$i] = new deducciones();
            $empleado[$i] = new empleado();
            $nomina[$i] = new nomina();
            //Generar Nomina Datos Empleado
            $idNomina[$i] = $randomN.$randomS.$randomN2.$randomS2.$i;
            $nomina[$i]->datosNomina($idNomina[$i]);
            $percepciones[$i]->datosPer($idNomina[$i]);
            $deducciones[$i]->datosDec($idNomina[$i]);
            $idEmpleado[$i] = $nomina[$i]->getIdEmpleado();
            $empleado[$i]->consultaDatos($idEmpleado[$i]);
            $empleado[$i]->DatosLabores($idEmpleado[$i]);
            $qrCode[$i] = new QrCode("https://www.sat.gob.mx/".
                          $idNomina[$i]);//Creo una nueva instancia de la clase
            $qrCode[$i]->setSize(250);//Establece el tamaño del qr
            $image[$i]= $qrCode[$i]->writeString();
            $imageData[$i] = base64_encode($image[$i]);

            //Calculos desde php.
            $diasTra[$i]=$nomina[$i]->getDiasTrabajados() - 1;
            $total[$i]=$percepciones[$i]->getSueldo() - $empleado[$i]->getSd();
            $diasTrab[$i] = $nomina[$i]->getDiasTrabajados() - 1 ;
            $total[$i]=$percepciones[$i]->getSueldo() - $empleado[$i]->getSd();
                
            if ($percepciones[$i]->getHoraExtra() == null){}
            else{
                $horasExtrT[$i] = "Horas Extra: ";
                $horasExtr[$i]= $asistencia[$i]->horasExtra($idEmpleado[$i], 
                $nomina[$i]->getFechaInicial(), 
                $nomina[$i]->getFechaFinal());
            }
            if ($percepciones[$i]->getHoraExtra() == null){}
            else{
               $cantHoras[$i]=$percepciones[$i]->getHoraExtra();
            }
                
            //html para la nomina.
            $html[$i] ='<html lang="es">
                    <body style="font-size: 10px;">
                        <div style="width: 80%;margin-left: 10%;">
                            <p style="text-align: center;">Clinica Santa Bárbara
                            </p>
                            <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <br>Sucursal: '.
                                            $empleado[$i]->getNomSucursal().
                                            '<br>Dirección:'.
                                            $empleado[$i]->getDireccionSucursal()
                                            .'
                                            <p>
                                            Emisor:
                                            <br>C.P. 45066
                                            <br>RFC: EMA110502N74
                                            <br>Registro Patronal: B8812181105
                                            <br>Entidad:
                                            </p>
                                            </td>
                                            <td>
                                                <img src="../img/logo.png" 
                                                width="300" height="100px">
                                            </td>
                                        </tr>
                                    </tbody>
                            </table>
                            <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td>               
                                                <p>
                                                Fecha de Ingreso:
                                                <br>
                                                S.D:
                                                <br>
                                                No. Trab:
                                                <br>
                                                Nombre:
                                                <br>
                                                CURP:
                                                <br>
                                                RFC:
                                                </p>
                                            </td>
                                            <td>
                                            <p>
                                            '.$empleado[$i]->getFechaIngreso().'
                                            <br>
                                            '.$empleado[$i]->getSd().'
                                            <br>
                                            '.$idEmpleado[$i].'
                                            <br>
                                            '.$empleado[$i]->getNombre().' '
                                            .$empleado[$i]->getApellidoPaterno()
                                            .' '.
                                            $empleado[$i]->getApellidoMaterno().'
                                            <br>
                                            '.$empleado[$i]->getCurp().'
                                            <br>
                                            '.$empleado[$i]->getRfc().'
                                            </p>
                                            </td>
                                            <td>
                                                <p>
                                                NSS:
                                                <br>
                                                Periodicidad:
                                                <br>
                                                Aréa:
                                                <br>
                                                Puesto:
                                                <br>
                                                Periodo del:
                                                <br>
                                                Dias Trabajados:
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                '.$empleado[$i]->getNss().'
                                                <br>
                                                '.$nomina[$i]->getPeriodo().'
                                                <br>
                                                '.$empleado[$i]->getNomDepartamento().'
                                                <br>
                                                '.$empleado[$i]->getNomPuesto().'
                                                <br>
                                                '.$nomina[$i]->getFechaInicial()
                                                . " al " . 
                                                $nomina[$i]->getFechaFinal().'
                                                <br>
                                                '.$nomina[$i]->getDiasTrabajados().'
                                                </p>
                                            </td>
                                                </tr>
                                            </tbody>
                            </table>
                            <br>
                            <table width="100%">
                                <tr>
                                    <th style="width: 50%;background: 
                                    #000;color:#FFF;">
                                        PERCEPCIONES
                                    </th>
                                    <th style="width: 55%;background: 
                                    #000;color:#FFF;">DEDUCCIONES</th>
                                </tr>
                            </table>
                            <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%;">
                                                <p>
                                                    SEPTIMO DIA:
                                                    <br>
                                                    SUELDO:
                                                    <br>
                                                    '.$horasExtrT[$i].'
                                                </p>
                                            </td>
                                            <td style="width: 10%;">
                                                1
                                                <br>
                                                '.$diasTra[$i].'
                                                <br>
                                                '.$horasExtr[$i].'
                                            </td>
                                            <td style="width: 12%;">
                                                '."$".$empleado[$i]->getSd().'
                                                <br>
                                                '."$".$total[$i].'
                                                <br>
                                                    '.$cantHoras[$i].'
                                            </td>
                                            <td style="width: 30%;">
                                                CUOTA IMSS:
                                                <br>
                                                ISR:
                                            </td>
                                            <td style="width: 10%;">

                                            </td>
                                            <td style="width: 8%;">
                                            '."$".$deducciones[$i]->getNSS().'
                                            <br>
                                            '."$".$deducciones[$i]->getISTP().'
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <hr>
                            <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td>               
                                                <p>
                                                Total de Percepciones:
                                                <br>
                                                </p>
                                            </td>
                                            <td>
                                            <p>
                                            '."$".
                                            $percepciones[$i]->
                                            getMontoPercepciones().'
                                             <br>
                                            </p>
                                            </td>
                                            <td>
                                                <p>
                                                Total de Deducciones:
                                                <br>
                                                Neto:
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                '."$".$deducciones[$i]->
                                                getMontoDeducciones().'
                                                <br>
                                                '."$".$nomina[$i]->
                                                getPagoTotal().'
                                                </p>
                                            </td>
                                                </tr>
                                            </tbody>
                            </table>
                            <hr>
                            <div style="width: 100%;">
                                <p style="width: 100%;background: #000;color:
                                #FFF;text-align: center;">Comprobante Fiscal 
                                Digital por Internet</p>
                                <table border="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width: 50%;">
                                                    <p >
                                                    <b>Folio Fiscal:</b> 
                                                    164C5E8F-CF4D-46A0-91F1-633
                                                    A715D32FC<br>
                                                    <b>Fecha de certificación:
                                                    </b>'.date("Y/m/d").'<br>
                                                    <b>No. de serie del CSD del 
                                                    SAT:
                                                    </b>
                                                        00001000000404341938
                                                    <br>
                                                    </p>
                                                </td>
                                                <td>
                                                <p>
                                                <b>Lugar de emisión:</b>
                                                45066 - ZAPOPAN, JALISCO<br>
                                                <b>Fecha de emisión:</b>
                                                '.date("Y/m/d").' <br>
                                                <b>
                                                No. de serie del CSD del emisor:
                                                </b> 00001000000407355760<br>
                                                </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>
                                                    <b>
                                                        Forma de pago:
                                                    </b> 99 - Por definir <br>
                                                    <b>
                                                        Método de pago:</b> PUE 
                                                        - Pago en una sola 
                                                        exhibición <br>
                                                    <b>Moneda:</b> MXN <br>
                                                    <b>Tipo Comprobante:</b><br>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <hr>
                                <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="width: 33%;">
                                                    <p><b>Concepto:</b> 
                                                    Pago de Nómina
                                                    </p>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </td>
                                                <td style="width: 33%;">
                                                    <p>
                                                    <b>Total Percepciones 
                                                    (Subtotal):<br>
                                                    Total de Deducciones:<br>
                                                    ISR Retenido:<br>
                                                    Subsidio al Empleado:<br>
                                                    Neto Pagado (Total):<br></b>
                                                    </p>
                                                </td>
                                                <td style="width: 33%;">
                                                    <p>
                                                        '."$".
                                                        $percepciones[$i]->
                                                        getMontoPercepciones().'
                                                        <br>
                                                        '."$".
                                                        $deducciones[$i]->
                                                        getMontoDeducciones().
                                                        '<br>
                                                        '."$". 
                                                        $deducciones[$i]->
                                                        getISTP().'<br>
                                                        '."$".
                                                        $percepciones[$i]->
                                                        getSubsidio().'<br>
                                                        '."$".$nomina[$i]->
                                                        getPagoTotal().'<br>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    FIRMA:______________________
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <br>
                                    <b>
                                        Sello Digital del Contribuyente Emisor:
                                    </b>
                                <br>
                                <p>'.strtoupper($nomina[$i]->getIdNomina())
                                    .'KzEMZtL'.
                                    strtoupper($nomina[$i]->getIdNomina())
                                .'XuYqr5e11F0FmjnL9qG5m4vZPZN9pyuDRRbeOcU+
                                oopvf9NzF99D0ACuI0ZyDJfgpLA/10EWiGmEsRb1j/+hPGS
                                DeWudDShFG3934JNWgFeM4/hsCGPqyd6KyrsVrxfB/UzOr+
                                W0fV4Uwe6yVQIPy63jX9B8OrBD
                                fjOJ5kZjte4lrMbvKYTsVrjiThZ25I2FEZgZXnRmqDV2+xN
                                OaIQpnjusO7CA9kG3w7uZNi/TTrCiEwQNFCXYlCc/LNRLjNR
                                dLuiZUQ88MWfP9SNVaqopc9PJsomsFRwxCGFH3CI53Ng/'
                                .strtoupper($nomina[$i]->getIdNomina()).'==</p>
                                <br><b>Sello Digital del SAT::</b><br>
                                <p>nK/'.strtoupper($nomina[$i]->getIdNomina())
                                .'/muRJMo0Pr3NXUp1zetvrMddx/DCqblWAU1zkv31qhJku
                                w+xmmQU3DNMZGpr2iWJbMfIrfDlXb7CnrASUMtckUd
                                v8g3bfUuKfjVWrEtI8Mf51QI51HlfJHxidmDHpDuds/'.
                                $nomina->getIdNomina().'/uhXap93LBBnKNXizhi7unkS
                                KoTgIH43tNgh+k261jBrQe1H4HkTI8cBn8VK+sR4MwYbWT4Y
                                da+Phq1jyXkufhmT4ALyJwe3VWpwvD2Nk9B4FJsBsgzwLta
                                hvR5c/VKMoiM+42ozfdhD++rnT7V7wFUFz2m9'
                                .strtoupper($nomina[$i]->getIdNomina()).
                                '==</p>
                                <table>
                                    <tbody>
                                        <tr>
                                        <td style="width: 30%;">
                                           <img src="data:image/png;base64,'.
                                            $imageData[$i].'">
                                        </td>
                                        <td style="width: 70%;">
                                        <b>Cadena Original del 
                                        complemento de certificación 
                                        digital del SAT:</b><br>
                                        <p>||1.1|164C5E8F-CF4D-46A0-91F1
                                        -633A715D32FC|20/06/2019 
                                        11:44:35 a. m.|'.
                                        strtoupper($nomina[$i]->getIdNomina())
                                        .'tL0dpbhD4pptcc0EFX
                                        uYqr5e11F0FmjnL9qG5m4vZPZN9pyuDRRbeOcU+o
                                        opvf9NzF99D0ACuI0ZyDJfgpLA/10EWiGmEsRb1j
                                        /+hPGSDeWudDShFG3934JNWgFeM4/hsCGPqyd6Ky
                                        rsVrxfB/UzOr+W0fV4Uwe6yVQIPy63jX9B8OrBDf
                                        jOJ5kZjte4lrMbvKYTsVrjiThZ25I2FEZgZXnRmq
                                        DV2+xNOaIQpnjusO7CA9kG3w7uZNi/TTrCiEwQNF
                                        CXYlCc/LNRLjNRdLuiZUQ88MWfP9SNVaqopc9PJs
                                        omsFRwx'.
                                        strtoupper($nomina[$i]->getIdNomina()).
                                        '/D cEhGsl5eocA==|00001000000404341938|
                                        </p>
                                        <b>
                                            Este documento es una representación
                                            impresa de un CFDI
                                        </b>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>

                            </div>
                    </div>
                </body>
                </html>';
            $name[$i] = $idNomina[$i].'_'.
                        $empleado[$i]->getApellidoPaterno()
                        ."_".$empleado[$i]->getApellidoMaterno().
                        "_".$empleado[$i]->getNombre();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html[$i]);
            $ruta[$i]='../nominas/'.$name[$i].'.pdf';
            $mpdf->Output($ruta[$i], 'F');
             
            //Enviar correo electronico a los usuarios.
            $destino[$i]= $empleado[$i]->getEmail();
            $nombreAu = 'Clinica Santa Barbara';
            $asunto = '[Clinica Santa Barbara]: Nomina Electronica';
            $mensaje = '<p>Ha recibido la n&oacute;mina del periodo '.$fechaIni
                        .' al '.$fechaFin.' de la Cl&iacute;nica Santa B&aacute;'
                        . 'rbara asociada con esta direcci&oacute;n de correo '
                        . 'electr&oacute;nico ('.
                        $destino[$i].'). Para visualizar, haga clic en el 
                        siguiente enlace:</p>
                        <a href="'.$link.'/ver_nomina.php?nom='.$idNomina[$i].
                        '">'.$link.'/ver_nomina.php?nom='.$idNomina[$i].'</a>
                        <p>Tambi&eacute;n puede copiar y pegar el enlace 
                        anterior en una nueva ventana del navegado</p>
                        <p> Las respuestas a este correo electr&oacute;nico 
                        no son monitoreadas o contestadas.</p>';
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
            $mail->setFrom('help@alphantastic.es', $nombreAu);
            $mail->addAddress($destino[$i]);

            $name[$i] = $idNomina[$i].'_'.$empleado[$i]->getApellidoPaterno()."_"
                       .$empleado[$i]->getApellidoMaterno()."_".
                        $empleado[$i]->getNombre();
            $name2[$i]=$name[$i].'.pdf';
            $ruta2[$i]='../nominas/'.$name[$i].'.pdf';
            $mail->addAttachment($ruta2[$i], $name2[$i]);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body    = $mensaje;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $query3= $pdo->prepare("SELECT periodo FROM nomina ORDER BY periodo "
                 . "DESC;");
        $query3->execute();
        $periodo= $query3->fetchColumn();
        echo '<script>location.href ="'.$link.'/buscarNom.php";</script>';
        }   
    }
}
?>

