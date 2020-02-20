<?php
include('qr/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;
include './addons/config.php';
include './class/turno.php';
include './class/puesto.php';
include './class/conexion.php';
include './class/empleado.php';
include './class/nomina.php';
include './class/percepciones.php';
include './class/deducciones.php';
include './class/asistencia.php';

$asistencia = new asistencia();
$percepciones = new percepciones();
$deducciones = new deducciones();
$nomina = new nomina();
$empleado = new empleado();

if(!isset($_GET['nom']))$idNomina="";
else$idNomina=$_GET['nom'];
$nomina->datosNomina($idNomina);
$percepciones->datosPer($idNomina);
$deducciones->datosDec($idNomina);
$idEmpleado = $nomina->getIdEmpleado();
$empleado->consultaDatos($idEmpleado);
$empleado->DatosLabores($idEmpleado);
$turno = new turno();
$puesto= new puesto();
 session_start();
$fechaIniG=$nomina->getFechaInicial();
$fechaFinG=$nomina->getFechaFinal();
$puestoG=$empleado->getIdPuesto();
$areaG=$empleado->getIdSucursal();
$empleadoG=$nomina->getIdEmpleado();
$nombreG=$empleado->getNombre().$empleado->getApellidoPaterno();


$qrCode = new QrCode("https://www.sat.gob.mx/".$nomina->getIdNomina());//Creo una nueva instancia de la clase
$qrCode->setSize(250);//Establece el tamaño del qr
//header('Content-Type: '.$qrCode->getContentType());
$image= $qrCode->writeString();//Salida en formato de texto 
$imageData = base64_encode($image);//Codifico la imagen usando base64_encode
 
if(isset($_SESSION['idPuesto'])== 6 || isset($_SESSION['idPuesto']) == 1){
?>
<html lang="es">
    <body >
        <div style="width: 80%;margin-left: 10%;">
            <p style="text-align: center;">Clinica Santa Bárbara</p>
            <table width="100%">
                    <tbody>
                        <tr>
                            <td>
                            <?php echo "<br>Sucursal: ".$empleado->getNomSucursal()."<br>Dirección: ". $empleado->getDireccionSucursal(); ?>
                            <p>
                                Emisor:
                                <br>C.P. 45066
                                <br>RFC: EMA110502N74
                                <br>Registro Patronal: B8812181105
                                <br>Entidad:
                            </p>
                            </td>
                            <td>
                                <img src="img/logo.png" width="300" height="100px">
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
                                <?php echo $empleado->getFechaIngreso(); ?>
                                <br>
                                <?php echo $empleado->getSd(); ?>
                                <br>
                                <?php echo $idEmpleado; ?>
                                <br>
                                <?php echo $empleado->getNombre()." ".$empleado->getApellidoPaterno()." ".$empleado->getApellidoMaterno(); ?>
                                <br>
                                <?php echo $empleado->getCurp(); ?>
                                <br>
                                <?php echo $empleado->getRfc(); ?>
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
                                <?php echo $empleado->getNss();?>
                                <br>
                                <?php echo $nomina->getPeriodo(); ?>
                                <br>
                                <?php echo $empleado->getNomDepartamento(); ?>
                                <br>
                                <?php echo $empleado->getNomPuesto(); ?>
                                <br>
                                <?php echo $nomina->getFechaInicial(). " al " . $nomina->getFechaFinal();  ?>
                                <br>
                                <?php echo $nomina->getDiasTrabajados(); ?>
                                </p>
                            </td>
                                </tr>
                            </tbody>
            </table>
            <br>
            <table width="100%">
                <tr>
                     <th style="width: 50%;background: #000;color:#FFF;">PERCEPCIONES</th>
                    <th style="width: 55%;background: #000;color:#FFF;">DEDUCCIONES</th>
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
                                    <?php 
                                    if ($percepciones->getHoraExtra() == null){}
                                    else{
                                        echo 'Horas extra:';
                                    }
                                    ?>
                                </p>
                            </td>
                            <td style="width: 10%;">
                                1
                                <br>
                                <?php echo $nomina->getDiasTrabajados() - 1; ?>
                                <br>
                                <?php 
                                    if ($percepciones->getHoraExtra() == null){}
                                    else{
                                        echo $asistencia->horasExtra($idEmpleado, $nomina->getFechaInicial(), $nomina->getFechaFinal());
                                    }
                                    ?>
                            </td>
                            <td style="width: 12%;">
                                <?php echo "$".$empleado->getSd(); ?>
                                <br>
                                <?php 
                                $total=$percepciones->getSueldo() - $empleado->getSd();
                                echo "$".$total; ?>
                                <br>
                                <?php 
                                    if ($percepciones->getHoraExtra() == null){}
                                    else{
                                        echo "$".$percepciones->getHoraExtra();
                                    }
                                    ?>
                            </td>
                            <td style="width: 30%;">
                                CUOTA IMSS:
                                <br>
                                ISR:
                            </td>
                            <td style="width: 10%;">
                                
                            </td>
                            <td style="width: 8%;">
                                <?php echo "$".$deducciones->getNSS(); ?>
                                <br>
                                <?php echo "$".$deducciones->getISTP(); ?>
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
                                 <?php echo "$".$percepciones->getMontoPercepciones(); ?>
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
                                <?php echo "$".$deducciones->getMontoDeducciones(); ?>
                                <br>
                                <?php echo "$".$nomina->getPagoTotal(); ?>
                                </p>
                            </td>
                                </tr>
                            </tbody>
            </table>
            <hr>
            <div style="width: 100%;">
                <p style="width: 100%;background: #000;color:#FFF;text-align: center;">Comprobante Fiscal Digital por Internet</p>
                <table border="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">
                                    <p >
                                    <b>Folio Fiscal:</b> 164C5E8F-CF4D-46A0-91F1-633A715D32FC<br>
                                    <b>Fecha de certificación:</b> <?php  echo date("Y/m/d"); ?> <br>
                                    <b>No. de serie del CSD del SAT:</b> 00001000000404341938<br>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                    <b>Lugar de emisión:</b> 45066 - ZAPOPAN, JALISCO<br>
                                    <b>Fecha de emisión:</b> <?php  echo date("Y/m/d"); ?> <br>
                                    <b>No. de serie del CSD del emisor:</b> 00001000000407355760<br>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                        <b>Forma de pago:</b> 99 - Por definir <br>
                                    <b>Método de pago:</b> PUE - Pago en una sola exhibición <br>
                                    <b>Moneda:</b> MXN <br>
                                    <b>Tipo Comprobante:</b> <br>
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
                                    <p><b>Concepto:</b> Pago de Nómina</p><br><br><br><br>
                                </td>
                                <td style="width: 33%;">
                                    <p>
                                    <b>Total Percepciones (Subtotal):<br>
                                    Total de Deducciones:<br>
                                    ISR Retenido:<br>
                                    Subsidio al Empleado:<br>
                                    Neto Pagado (Total):<br></b>
                                    </p>
                                </td>
                                <td style="width: 33%;">
                                    <p>
                                        <?php echo "$".$percepciones->getMontoPercepciones(); ?><br>
                                        <?php echo "$".$deducciones->getMontoDeducciones(); ?><br>
                                        <?php echo "$".$deducciones->getISTP();?> <br>
                                        <?php echo "$".$percepciones->getSubsidio(); ?><br>
                                        <?php echo "$".$nomina->getPagoTotal(); ?><br>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    FIRMA:__________________________
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <br><b>Sello Digital del Contribuyente Emisor:</b><br>
                <p><?php echo strtoupper($nomina->getIdNomina()); ?>KzEMZtL<?php echo $nomina->getIdNomina(); ?>XuYqr5e11F0FmjnL9qG5m4vZPZN9pyuDRRbeOcU+oopvf9NzF99D0ACuI0ZyDJfgp
                LA/10EWiGmEsRb1j/+hPGSDeWudDShFG3934JNWgFeM4/hsCGPqyd6KyrsVrxfB/UzOr+W0fV4Uwe6yVQIPy63jX9B8OrBD
                fjOJ5kZjte4lrMbvKYTsVrjiThZ25I2FEZgZXnRmqDV2+xNOaIQpnjusO7CA9kG3w7uZNi/TTrCiEwQNFCXYlCc/LNRLjNR dLuiZUQ88MWfP9SNVaqopc9PJsomsFRwxCGFH3CI53Ng/<?php echo $nomina->getIdNomina(); ?>==</p>
                <br><b>Sello Digital del SAT::</b><br>
                <p>nK/<?php echo strtoupper($nomina->getIdNomina()); ?>/muRJMo0Pr3NXUp1zetvrMddx/DCqblWAU1zkv31qhJkuw+xmmQU3DNMZGpr2iWJbMfIrfDlXb7CnrASUMtckUd
                v8g3bfUuKfjVWrEtI8Mf51QI51HlfJHxidmDHpDuds/<?php echo $nomina->getIdNomina(); ?>/uhXap93LBBnKNXizhi7unkS
                KoTgIH43tNgh+k261jBrQe1H4HkTI8cBn8VK+sR4MwYbWT4Yda+Phq1jyXkufhmT4ALyJwe3VWpwvD2Nk9B4FJsBsgzwLta hvR5c/VKMoiM+42ozfdhD++rnT7V7wFUFz2m9<?php echo $nomina->getIdNomina(); ?>==</p>
                <table >
                        <tbody>
                            <tr>
                                <td style="width: 33%;">
                                   <?php echo '<img src="data:image/png;base64,'.$imageData.'">'; ?> 
                                </td>
                                <td style="width: 70%;">
                                    <b>Cadena Original del complemento de certificación digital del SAT:</b><br>
                                    <p>||1.1|164C5E8F-CF4D-46A0-91F1-633A715D32FC|20/06/2019 11:44:35 a. m.|<?php echo strtoupper($nomina->getIdNomina()); ?>tL0dpbhD4pptcc0EFX
                           uYqr5e11F0FmjnL9qG5m4vZPZN9pyuDRRbeOcU+oopvf9NzF99D0ACuI0ZyDJfgpLA/10EWiGmEsRb1j/+hPGSDeWudDShFG3934
                          JNWgFeM4/hsCGPqyd6KyrsVrxfB/UzOr+W0fV4Uwe6yVQIPy63jX9B8OrBDfjOJ5kZjte4lrMbvKYTsVrjiThZ25I2FEZgZXnRmq
                          DV2+xNOaIQpnjusO7CA9kG3w7uZNi/TTrCiEwQNFCXYlCc/LNRLjNRdLuiZUQ88MWfP9SNVaqopc9PJsomsFRwx<?php echo strtoupper($nomina->getIdNomina()); ?>/D cEhGsl5eocA==|00001000000404341938|</p>
                                    <b>Este documento es una representación impresa de un CFDI</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>

            </div>
    </div>
</body>
</html>
<?php
} else {
   header("Location: /panel.php");
}
?>