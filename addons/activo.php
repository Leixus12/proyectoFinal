<?php

/**
 * Verifica si sigue logeado el empleado mediante la variable SESSION
 * de lo contrario lo manda a que ingrese de nuevo
 */
session_start();
if($_SESSION['valido'] == 1){}
else {
    header("Location: index.php");
}
?>
