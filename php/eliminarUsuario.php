
<?php

include "./conexion.php";

$id = $_POST['id'];
$conexion->query("delete from usuarios where id=$id");  
header("Location: ./../usuarios.php");
?>