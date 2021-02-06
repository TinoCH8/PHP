<?php

$servidor='localhost';
$nombreBD='escuela';
$usuario='root';
$pass='';
$conexion = new mysqli($servidor, $usuario, $pass, $nombreBD);

if($conexion -> connect_error){
    die("no se pudo conectar a la base de datos");
}


?>