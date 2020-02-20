<div id="section-home">
<div class="container">
<div class="row">
<div class="col-lg-6">
<div class="principal-title text-center">Vacaciones</div>
<div class="secondary-title">Registro de días:</div>
<div class="alert alert-light" role="alert">
    <b>En este apartado podrás ver los días en los cuales ya solicitaste vacaciones. </b><br />
</div>
<div class="card">
<div class="card-body">
<?php
    
    if(!$alerta == 'save'){
    }else{
        echo '<div class="alert alert-success" role="alert">Datos Actualizados Correctamente.<script>$(document).ready(function () {window.setTimeout(function () {location.href = "'.$link.'/profile.php";}, 1000);});</script></div>';
    }
?>

    <div class="col-lg-12">
<div style="margin-top: 5%;">
                            <center><label class="h4 text-black" >Días Autorizados:</label></center>
                                <table class=" table table-bordered table-hover text-center">
                                    <tbody>
                                        <tr>
                                        <td>Fecha de inicio:</td>
                                        <td>Fecha de fin:</td>
                                        <td>Estado:</td>
                                      </tr>
                                       <?php echo $vacaciones->solicitudAprobada($idEmpleado); ?>
                                    </tbody>
                                </table>
                    </div>
    </div>
    <br>
</div>
</div>

<div id="myModal" class="modal textB">

                          <!-- Modal content -->
                          <div class="modal-content">
                            <div class="modal-header ">
                              <h2>Petición de días:</h2>
                              <span class="close">&times;</span>
                            </div>
                            <div class="modal-body">
                              <p>Aquí podrás ver el estatus de tus días solicitados</p>
                              <center><label class="h4 text-black" >Días Pedidos:</label></center>
                                <table class=" table table-bordered table-hover text-center">
                                    <tbody>
                                        <tr>
                                        <td>Fecha de inicio:</td>
                                        <td>Fecha de fin:</td>
                                        <td>Estado:</td>
                                        </tr>
                                        <?php echo $vacaciones->solicitudes($idEmpleado); ?>
                                    </tbody>
                                </table>
                            </div>
                          </div>

                        </div>
</div>

<div class="col-lg-5">
<div class="secondary-title mt-5">Menú</div>
<div class="list-group">
<a href="<?php echo $link;?>/vacaciones.php" class="list-group-item list-group-item-action">
<h5 class="mb-1"><img src="<?php echo $link; ?>/img/nav/icon8.png"> Solicitar días.</h5>
<p class="mb-1">Podrás mandar una solicitud para días vacacionales.</p>
</a>
<a href="<?php echo $link;?>/vacaciones.php?tab=2" class="list-group-item list-group-item-action activo">
<h5 class="mb-1"><img src="<?php echo $link; ?>/img/nav/icon7.png"> Días Registrados.</h5>
 <p class="mb-1">Podras ver los días de vacaciones.</p>
</a>
<center>
<div class="light" style="margin-top: 5%;">
<div class="form-group col-lg-6 text-center">
    <label class="text-black">Fecha de Ingreso:</label>
    <input class="form-control text-center" name="fechaIn" value="<?php echo $empleado->getFechaIngreso(); ?>" readonly>
    <p class="mb-1">Días disponibles: <?php echo $diasVacaciones; ?></p>
</div>
</div>
</center>
<button id="myBtn" class="btn btn-primary">Peticiones</button>
</div>
</div>
<div class="col-lg-6">
        
</div>

</div>
</div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    </script>
