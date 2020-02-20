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
<li class="nav-item active">
<a class="nav-link" href="<?php echo $link; ?>/panel.php"><div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon12.png)"></div>Inicio</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo $link ?>/nominaE.php"><div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon35.png);"></div>Nominas</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo $link; ?>/vacaciones.php"><div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon24.png)"></div>Vacaciones</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo $link; ?>/profile.php"><div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon5.png)"></div>Ajustes</a>
</li>
<?php
    if($_SESSION['idPuesto'] == "6" || $_SESSION['idPuesto'] == "1" ){
?>
<li class="nav-item">
<a class="nav-link" href="<?php echo $link; ?>/buscarNom.php"><div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon17.png)"></div>Administración</a>
</li>
<?php
    }
?>
</ul>

<ul class="navbar-nav justify-content-end" style="text-align:right;" >
<li class="nav-item">
<a class="nav-link" href="<?php echo $link; ?>/logout.php"><div class="navbar-icon" style="background-image:url(<?php echo $link; ?>/img/nav/icon1.png)"></div>Salir</a>
</li>
</ul>
</div>
</div>
</nav>
