<?php
include 'config.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<img src="img/logo.png" width="150px" height="50">
<div class="container">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto" style="text-align:center;">
<!-- Menu Primero -->
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon7.png)"></div>NOMINAS
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="<?php echo $link; ?>/generarNom.php"><div class="navbar-icon"><img src="<?php echo $link; ?>/img/nav/icon16.png"></div>Generar</a>
<a class="dropdown-item" href="<?php echo $link; ?>/buscarNom.php"><div class="navbar-icon"><img src="<?php echo $link; ?>/img/nav/icon18.png"></div>Modificar</a>
</div>
</li>
<!--Menu Secundario-->
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon41.png)"></div>ASISTENCIA
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="<?php echo $link; ?>/buscarAsistencia.php"><div class="navbar-icon"><img src="<?php echo $link; ?>/img/nav/icon38.png"></div>Modificar</a>
</div>
</li>
<!--Menu Tercero-->
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon24.png)"></div>VACACIONES
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="<?php echo $link; ?>/peticiones.php"><div class="navbar-icon"><img src="<?php echo $link; ?>/img/nav/icon8.png"></div>PETICIONES</a>
</div>
</li>
<!--Menu Cuarto-->
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon5.png)"></div>USUARIO
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="<?php echo $link; ?>/crearUsuario.php"><div class="navbar-icon"><img src="<?php echo $link; ?>/img/nav/icon10.png"></div>Crear</a>
<a class="dropdown-item" href="<?php echo $link; ?>/buscarEmpleado.php"><div class="navbar-icon"><img src="<?php echo $link; ?>/img/nav/icon11.png"></div>Modificar</a>
</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon17.png)"></div>DETALLE Nómina
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="<?php echo $link; ?>/buscarPuestos.php"><div class="navbar-icon"><img src="<?php echo $link; ?>/img/nav/icon44.png"></div>Puestos</a>
<a class="dropdown-item" href="<?php echo $link; ?>/buscarIsr.php"><div class="navbar-icon"><img src="<?php echo $link; ?>/img/nav/icon45.png"></div>ISR</a>
</div>
</li>
</ul>

<ul class="navbar-nav justify-content-end" style="text-align:right;" >
<li class="nav-item">
<a class="nav-link" href="<?php echo $link; ?>/panel.php"><div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon1.png)"></div>Salir</a>
</li>
</ul>
</div>
</div>
</nav>
