<?php
session_start();
include './addons/config.php';
include './class/conexion.php';
include './class/isr.php';

$isr = new isr();
$idIsr= $_GET['id'];
$isr->datosIsr($idIsr);

 if(isset($_SESSION['idPuesto']) == 1 || isset($_SESSION['idPuesto']) == 6 ){
?>
<html lang="es">
    <head>
        <title>Panel ~ Gestión de ISR</title>
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="css/cosmos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/propio.css">
    <script src="js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/propio.js"></script>
    </head>
    <body >
        <?php include './addons/menuP.php'; ?>
        <div class="rows">
            <div class="container-fluid">
                   <div class="col-lg-12 light">
                       <p class="text-center h1" style="color: #000;">Gestión de ISR</p>
                       <div class="col-lg-9 col-lg-offset-2">
                           <div class="col-lg-4">
                               <form class="form" method="POST" action="actions/mod_isr.php">
                                   <div class="form-group" style="display: none;">
                                   <label class="h4">Monto (día):</label>
                                   <input type="text" maxlength="20" name="idIsr" value="<?php echo $isr->getIdIsr();?>" id="idIsr" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label class="h4">Monto (día):</label>
                                   <input type="text" maxlength="20" name="montoIsr" value="<?php echo $isr->getMonto();?>" id="montoIsr" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label class="h4">Porcentaje:</label>
                                   <input type="text" id="porcentajeIsr"  name="porcentajeIsr" value="<?php echo $isr->getMontoPorcentaje();?>" class="form-control">
                               </div>
                               <button type="submit" name="modIsr" class="btn btn-primary btn-lg">GUARDAR</button>
                               <a href="<?php echo $link; ?>/buscarIsr.php" class="btn btn-primary btn-lg">CANCELAR</a>
                           </form>
                       </div>
                           <div class="col-lg-4 col-lg-offset-1">
                               <img src="img/isr.png" width="70%" height="35%">
                           </div><br><br>
                           
                       </div>
                       
                   </div>
            </div>
        </div>
</div>
<?php include './addons/footer.php'; ?>
</body>

</html>
 <?php }else{
      header("Location: panel.php");
 }
?>