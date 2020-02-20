<?php
session_start();
include './addons/config.php';
include './class/conexion.php';
include './class/turno.php';
include './class/puesto.php';
include './class/sucursal.php';
include './class/departamento.php';
include './class/imss.php';
include './class/empleado.php';
$empleado = new empleado();
$turno = new turno();
$puesto = new puesto();
$sucursal = new sucursal();
$imss = new imss();
$departamento = new departamento();

$idEmpleado = $_GET['user'];
$empleado->DatosLabores($idEmpleado);
$empleado->consultaDatos($idEmpleado);



 if(isset($_SESSION['idPuesto']) == 1 || isset($_SESSION['idPuesto']) == 6 ){
?>
<html lang="es">
    <head>
        <title>Panel: Modificar empleado</title>
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="css/cosmos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/propio.css">
    <script src="js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/propio.js"></script>
    <script type="text/javascript">
        function nomUsuario(str){
			var xmlhttp;
		  	if (window.XMLHttpRequest){
			  xmlhttp=new XMLHttpRequest();
			  }else{
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
                          xmlhttp.onreadystatechange=function(){
			  if (xmlhttp.readyState==4 && xmlhttp.status==200){
				 document.getElementById("userExit").innerHTML=xmlhttp.responseText;
                                 if(xmlhttp.responseText != 0){
                                     document.getElementById("regUsuario").style.display="none";
                                 }else{
                                     document.getElementById("regUsuario").style.display="block";
                                 }
				 }
			  }
		 xmlhttp.open("GET","actions/validarUser.php?q="+str,true);
                 xmlhttp.send();
		}
        function confirmar(){
	if(confirm('¿Estas seguro de realizar esta acción?')){
            return true;
        }else{
        }return false;
}
    </script>
    </head>
    <body >
        <?php include './addons/menuP.php'; ?>
        <div class="rows">
            <div class="container-fluid">
                   <div class="col-lg-12 light">
                       <form name="regEmpleado" method="POST" action="actions/regUser.php">
                           <div class="col-lg-12 h5">
                               <p class="text-center h2">Datos Personales</p>
                               <p class="text-center h4">Rellena los campos obligatorios <span class="text-danger">(*)</span></p><br>
                           </div>
                           <div class="col-lg-12 h5">
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Nombre(s):  </label><span id="campTxt1" class="text-right text-danger"></span>
                                   <input class="form-control" type="text" name="nomEmp" onkeyup="this.value=campTxt1(this.value)" value="<?php echo $empleado->getNombre(); ?>" required>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span>  Apellido Paterno:</label><span id="campTxt2" class="text-right text-danger"></span>
                                   <input class="form-control" type="text" name="nomEmpP" onkeyup="this.value=campTxt2(this.value)" value="<?php echo $empleado->getApellidoPaterno(); ?>" required>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Apellido Materno: </label><span id="campTxt3" class="text-right text-danger"></span>
                                   <input class="form-control" type="text" name="nomEmpM" onkeyup="this.value=campTxt3(this.value)" value="<?php echo $empleado->getApellidoMaterno(); ?>" required>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Dirección:</label>
                                   <input class="form-control" style="height: 33px;" type="text" name="direcEmp" value="<?php echo $empleado->getDireccion(); ?>" required>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label>Teléfono:</label><span id="campNum1" class="text-right text-danger"></span>
                                   <input class="form-control" style="height: 33px;" type="text" name="telEmp" value="<?php echo $empleado->getTelefono(); ?>" onkeyup="this.value=campNum1(this.value)">
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Fecha de Nacimiento:</label>
                                   <input class="form-control" style="height: 33px;" type="date" name="fechaEmpNa" value="<?php echo $empleado->getFechaNacimiento(); ?>" required>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label>Email:</label>
                                   <input class="form-control" type="email" value="<?php echo $empleado->getEmail(); ?>" name="emailEmp">
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Curp:</label>
                                   <input class="form-control" type="text" name="curpEmp" value="<?php echo $empleado->getCurp(); ?>" required>
                                </div>
                               </div>
                           </div>
                            <div class="col-lg-12 h5">
                                <p class="text-center h2">Datos Laborales</p>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> RFC:</label>
                                   <input class="form-control" type="text" name="rfcEmp" value="<?php echo $empleado->getRfc(); ?>" required>
                                </div>
                               </div>
                                <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> NSS:</label><span id="campNum2" class="text-right text-danger"></span>
                                   <input class="form-control" type="text" name="nssEmp" value="<?php echo $empleado->getNss(); ?>" onkeyup="this.value=campNum2(this.value)" required>
                                </div>
                               </div>
                            </div><br>
                           <div class="col-lg-12 h5">
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Sucursal:</label>
                                   <?php echo $sucursal->sucDisp(); ?>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Aréa:</label>
                                   <?php echo $departamento->departDisp(); ?>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Puesto:</label>
                                   <?php echo $puesto->puestosDisp(); ?>
                                </div>
                               </div>
                           </div>
                           <div class="col-lg-12 h5">
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Turno:</label>
                                   <?php echo $turno->turnodisp();?>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> IMSS:</label>
                                   <?php echo $imss->imssDisp();?>
                                </div>
                               </div>
                           </div>
                            
                           <div class="col-lg-12 h5">
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Usuario:</label><span id="userExit" class="text-right"></span>
                                   <input class="form-control" type="text" name="userEmp" value="<?php echo $empleado->getNombreUsuario(); ?>" readonly required>
                                   <div class="col-lg-12 h5 text-center">
                                
                            </div>
                                </div>
                               </div>
                               <div class="col-lg-4">
                               <div class="form-group">
                                   <label><span class="text-danger">*</span> Contraseña:</label>
                                   <input class="form-control" type="password" value="<?php echo $empleado->getPassword(); ?>" name="passEmp" required>
                                </div>
                               </div>
                           </div>
                           
                            <button class="btn btn-primary btn-lg" id="regUsuario" onclick="return confirmar()" type="submit" name="okEmp">Guardar</button>
                       </form>
                   </div>
            </div>
        </div>
</div>
</body>
</html>
 <?php }else{
      header("Location: panel.php");
 }
?>