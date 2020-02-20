<div id="section-home">
<div class="container">
<div class="row">
<div class="col-lg-7">
<div class="principal-title text-center">Ajustes</div>
<div class="secondary-title">Datos Personales.</div>
<div class="alert alert-light" role="alert">
    <b>Es este apartado podrás actualizar tus datos personales, estos tiene que ser verídicos.</b><br />
</div>
<form action="actions/empleado.php" id="profileForm" method="post">
<div class="card">
<div class="card-body">
<?php
    if(!$alerta == 'save'){
    }else{
        echo '<div class="alert alert-success" role="alert">Datos Actualizados Correctamente.<script>$(document).ready(function () {window.setTimeout(function () {location.href = "'.$link.'/profile.php";}, 2500);});</script></div>';
    }
?>
<h6 class="card-title">Nombre:</h6>
<p class="card-text">
    <input class="form-control" name="nombreEmp" value="<?php echo $empleado->getNombre(); ?>" readonly>
    </p>
<hr>
<h6 class="card-title">Apellidos:</h6>
<p class="card-text">
    <input class="form-control" name="apellidoP" value="<?php echo $empleado->getApellidoPaterno()." ".$empleado->getApellidoMaterno(); ?>" readonly>
    </p>
<hr><h6 class="card-title">Email:</h6>
<p class="card-text">
    <input class="form-control" name="email" value="<?php echo $empleado->getEmail(); ?>" >
    </p>
<hr>
<h6 class="card-title">Dirección:</h6>
<p class="card-text">
    <input class="form-control" name="direccionE" value="<?php echo $empleado->getDireccion(); ?>">
    </p>
<hr>
<h6 class="card-title">Teléfono:</h6>
<p class="card-text">
    <input class="form-control" name="telefonoE" value="<?php echo $empleado->getTelefono(); ?>">
    </p>
<hr>
<button class="btn btn-primary" name="actEmpleado" onclick="return confirmar()" type="submit">Guardar cambios</button>
</div>
</div>
</form>
</div>
<div class="col-lg-5">
<div class="secondary-title mt-5">Menú</div>
<div class="list-group">
<a href="<?php echo $link;?>/profile.php" class="list-group-item list-group-item-action activo">
<h5 class="mb-1"><img src="<?php echo $link; ?>/img/nav/icon25.png"> Datos personales.</h5>
<p class="mb-1">Podrás editar otros cuantos ajustes.</p>
</a>
<a href="<?php echo $link;?>/profile.php?tab=2" class="list-group-item list-group-item-action">
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

