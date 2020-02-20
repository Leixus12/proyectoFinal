<div id="section-home">
<div class="container">
<div class="row">
<div class="col-lg-7">
<div class="principal-title">Ajustes</div>
<div class="secondary-title">Foto de perfil.</div>
<div class="alert alert-light" role="alert">
    <b>Es este apartado podras actualizar tu foto de perfil, recuerda este dato es personal en la foto tu cara de ser visible.</b><br />
</div>
<?php
                    if($alerta == 'error_size'){
                     echo '<div class="alert alert-danger" role="alert">El Tamaño de la foto o formato no es el correcto.<script>$(document).ready(function () {window.setTimeout(function () {location.href = "'.$link.'/profile.php?tab=2";}, 2500);});</script></div>';   
                    }
                    if($alerta == 'save_photo'){
                     echo '<div class="alert alert-success" role="alert">La foto de perfil se ha actualizado correctamente.<script>$(document).ready(function () {window.setTimeout(function () {location.href = "'.$link.'/profile.php?tab=2";}, 2500);});</script></div>';
                    }
                    ?>
<form action="actions/guardarFoto.php" method="POST" enctype="multipart/form-data" id="profileForm" name="profileForm">
<div class="card">
<div class="card-body">
<h5 class="card-title">Nombre:</h5>
<p class="card-text"><input id="contra1" class="form-control" maxlength="32" name="nombreF" size="32" type="email" value="<?php echo $nombreFoto;?>" readonly></p>
<h5 class="card-title">Imagen: </h5>
<p class="card-text"><input  type="file" name="FotoEMP" accept="image/*"></p>
<hr>
<button type="submit" onclick="return confirmar()" class="btn btn-primary" name="GuardaFo">Cambiar Foto</button>
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
<a href="<?php echo $link;?>/profile.php?tab=2" class="list-group-item list-group-item-action activo">
<h5 class="mb-1"><img src="<?php echo $link; ?>/img/nav/icon6.png"> Foto de Perfil.</h5>
 <p class="mb-1">Podras editar tu foto de perfil.</p>
</a>
<a href="<?php echo $link;?>/profile.php?tab=3" class="list-group-item list-group-item-action">
<h5 class="mb-1"><img src="<?php echo $link; ?>/img/nav/icon30.png"> Contraseña</h5>
<p class="mb-1">Cambio de la contraseña</p>
</a>
</div>
</div>
</div>
</div>
</div>