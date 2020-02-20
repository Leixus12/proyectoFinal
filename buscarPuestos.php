<?php 
include './addons/config.php';
include './class/conexion.php';
include './class/puesto.php';
session_start();
$puesto = new puesto();
?>
<html lang="es">
    <head>
        <title>Panel ~ Editar Puestos</title>
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="css/cosmos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $link; ?>/css/propio.css">
    <script src="js/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="js/propio.js?v11"></script>
    </head>
    <body >
        <?php include './addons/menuP.php'; ?>
        <div class="rows">
            <div class="container">
                <div class=”row”>
                   <div class="col-lg-12 light">
                       <p class="text-center h1" style="color: #000;">Gestión de puestos</p>
                           <div class="form col-lg-8">
                               <div class="h3">
                                   En este apartado podrás visualizar los puestos actuales, tanto como la gestión de ellos mismos.
                               </div>
                           </div>
                           <div class="form col-lg-4">
                               <div class="form-group">
                                   <br>
                                   <a href="<?php echo $link;?>/crearPuesto.php" class="btn btn-primary btn-lg" type="button" name="crearPuesto" id="crearPuesto" >Añadir</a><br>
                                </div>
                           </div>
                       <div class="col-lg-12">
                           <br>
                           <table border="1" id="nominas" class="table table-hover text-center" style="width: 100%;">
                               <thead style="width: 100%;" class="thead-blue">
                            <tr>
                                <th>Puesto</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                            </tr>
                            </thead>
		<?php 
                        if(isset($_GET['pagina'])){
                            $pagina = $_GET['pagina'];
			}else{
                            $pagina = 1;
			}
                        $pdo = new conexion();
			$sql_registe = $pdo->prepare("SELECT COUNT(*) as total_registro FROM puesto;");
                        $sql_registe->execute();
			$result_register = $sql_registe->fetchColumn();
			$por_pagina = 10;
			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($result_register / $por_pagina);
                        echo $puesto->puestoT($pagina, $link);
		 ?>
                           </table><br><br>
                </div>
                <div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php }else{
                            
                        } ?>
			</ul>
		</div>
                   </div>
            </div>
            </div>
        </div>
</div>
<?php include './addons/footer.php'; ?>
</body>
</html>