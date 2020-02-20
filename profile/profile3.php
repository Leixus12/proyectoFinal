<div id="section-home">
<div class="container">
<div class="row">
<div class="col-lg-7">
<div class="principal-title">Ajustes</div>
<div class="secondary-title">Contraseña</div>
<div class="alert alert-light" role="alert">
    <b>Es este apartado podras actualizar tu contraseña, recuerda este dato es personal y no puedes compartirlo con nadie.</b><br />
</div>
<?php
    if(!isset($_GET['message'])){
    }else{
        $messaje=$_GET['message'];
        if($messaje == 'save'){
         echo '<div class="alert alert-success" role="alert">Las modificaciones se han guardado con éxito.<script>$(document).ready(function () {window.setTimeout(function () {location.href = "'.$link.'/profile.php?tab=3";}, 2500);});</script></div>';
        } else {
         if($messaje == 'error_pass'){
           echo '<div class="alert alert-success" role="alert">Lo sentimos pero la contraseña ingresada no es la actual.<script>$(document).ready(function () {window.setTimeout(function () {location.href = "'.$link.'/profile.php?tab=3";}, 2500);});</script></div>';
         }else{
             if($messaje == 'error_equals'){
           echo '<div class="alert alert-success" role="alert">Lo sentimos, Verifica que las contraseñas ingresadas coincidan.</script><script>$(document).ready(function () {window.setTimeout(function () {location.href = "'.$link.'/profile.php?tab=3";}, 2500);});</script></div>';
         }
         }
         
        }
        
    }
?>
<form action="actions/empleado.php" id="profileForm" method="post" name="profileForm">
<div class="card">
<div class="card-body">
<h5 class="card-title">Contraseña actual</h5>
<p class="card-text"><input id="actual" class="form-control" maxlength="32" name="ppassword" size="32" type="password" placeholder="Contraseña actual" value="" required /></p>
<h5 class="card-title">Nueva contraseña</h5>
<p class="card-text"><input id="contra1" class="form-control" maxlength="32" name="pnpass" size="32" type="password" placeholder="Nueva contraseña" value="" required /></p>
<h5 class="card-title">Repite la nueva contraseña</h5>
<p class="card-text"><input id="contra2" class="form-control" maxlength="32" name="pnrp" size="32" type="password" placeholder="Repite la nueva contraseña" value="" required /></p>
<hr>
<input class="btn btn-primary" onclick="return confirmar()" name="actPassword" type="submit" value="Cambiar contraseña">
</div>
</div>
</form>
</div>
<div class="col-lg-5">
<div class="secondary-title mt-5">Menú</div>
<div class="list-group">
<a href="<?php echo $link;?>/profile.php" class="list-group-item list-group-item-action">
<h5 class="mb-1"><img src="<?php echo $link; ?>/img/nav/icon25.png"> Datos personales.</h5>
<p class="mb-1">Podrás editar otros cuantos ajustes.</p>
</a>
<a href="<?php echo $link;?>/profile.php?tab=2" class="list-group-item list-group-item-action">
<h5 class="mb-1"><img src="<?php echo $link; ?>/img/nav/icon6.png"> Foto de Perfil.</h5>
 <p class="mb-1">Podras editar tu foto de perfil.</p>
</a>
<a href="<?php echo $link;?>/profile.php?tab=3" class="list-group-item list-group-item-action activo">
<h5 class="mb-1"><img src="<?php echo $link; ?>/img/nav/icon30.png"> Contraseña</h5>
<p class="mb-1">Cambio de la contraseña</p>
</a>
</div>
</div>
</div>
</div>
</div>