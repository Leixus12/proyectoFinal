<?php
session_start();
if($_SESSION['valido'] == 1){}
else {
    header("Location: index.php");
}
?>
