<?php
session_start();
//session_destroy();
unset($_SESSION['uData']); //eliminar una sola variable de session
header("Location: ../login.php");
?>