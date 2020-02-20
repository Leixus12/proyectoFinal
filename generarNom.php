<?php 
session_start();
include './addons/config.php';
include './class/conexion.php';
 if(isset($_SESSION['idPuesto']) == 1 || isset($_SESSION['idPuesto']) == 6 ){
?>
<html lang="es">
    <head>
    <title>Panel ~ Crear nóminas</title>
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="css/cosmos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/propio.css">
    <script src="js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="js/modal.js"></script>
    <script src="js/propio.js?v11"></script>
    <script type="text/javascript">
function confirmar(){
    var fechaIni = document.getElementById("fechaIni").value;
    var fechaFin = document.getElementById("fechaFin").value;
    
	if(confirm('¿Estas seguro de realizar esta acción? \n\n \t\t\t Creación de nómina\n Periodo de pago del '+document.getElementById("fechaIni").value+" al "+document.getElementById("fechaFin").value)){
            if( fechaIni &&  fechaFin){
                document.getElementById('myModal').style.display="block";
            }
            return true;
        }else{
        }return false;
}
</script>
    </head>
    <body >
        <div id="myModal" class="modal" style="display: none;">
            <!-- Modal content -->
            <div class="">
              <center><div class="loading h3"><img src="images/loader2.gif"><br>Un momento, por favor...<br>Generando nóminas</div></center>
            </div>
            <br>
          </div>
        <?php include './addons/menuP.php'; ?>
        
            <div class="container">
                <div class="rows">
                   <div class="col-lg-12 light">
                       <p class="text-center h1" style="color: #000;">Generación de nóminas</p>
                       
                       <div class="col-lg-7 col-lg-offset-1">
                       <form method="POST" action="actions/crearNomina.php">
                       
                           <div class="form col-lg-5">
                           <div class="form-group">
                               <label>Fecha de Inicio:</label>
                               <input class="form-control" style="height: 35px;" id="fechaIni" name="fechaIni" type="date" required>
                           </div>
                           <div class="form-group">
                               <label>Fecha de Corte:</label>
                               <input class="form-control" style="height: 35px;" id="fechaFin" name="fechaFin" type="date" required>
                           </div>
                               <button class="btn btn-primary btn-lg" onclick="return confirmar()" type="submit" name="crearNomina" id="crearNomina" style="width: 50%;">Generar</button>
                           </div>
                       </form>
                       </div>
                       <div class="col-lg-4">
                           <img src="img/nom.png" width="100%" height="40%">
                       </div>
                   </div>
            </div>
        </div>
<?php include './addons/footer.php'; ?>
       
</body>
</html>
<?php
 }else {
 header("Location: panel.php");
 }
 ?>
