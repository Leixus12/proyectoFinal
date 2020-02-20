<?php
session_start();
include './addons/config.php';
include './class/conexion.php';

 if(isset($_SESSION['idPuesto']) == 1 || isset($_SESSION['idPuesto']) == 6 ){
?>
<html lang="es">
    <head>
        <title>Panel ~ Gestión de puestos</title>
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
                       <p class="text-center h1" style="color: #000;">Gestión de puestos</p>
                       <div class="col-lg-9 col-lg-offset-2">
                           <div class="col-lg-4">
                               <form class="form" method="POST" action="actions/mod_salario.php">
                               <div class="form-group">
                                   <label class="h4">Puesto:</label>
                                   <input type="text" maxlength="20" name="nomPuesto" id="nomPuesto" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label class="h4">Descripción:</label>
                                   <textarea maxlength="150" class="form-control" name="descPuest" ></textarea>
                               </div>
                               <div class="form-group">
                                   <label class="h4">Salario diario:</label>
                                   <input type="text" id="salPuesto" name="salPuesto" class="form-control">
                               </div>
                               <button type="submit" name="crearPuesto" class="btn btn-primary btn-lg">GUARDAR</button>
                               <a href="<?php echo $link; ?>/buscarPuestos.php" class="btn btn-primary btn-lg">CANCELAR</a>
                           </form>
                       </div>
                           <div class="col-lg-4 col-lg-offset-1">
                               <img src="img/puest.png" width="70%" height="35%">
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