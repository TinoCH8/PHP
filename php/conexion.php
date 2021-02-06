
<?php

$servidor='localhost';
$nombreBD='escuela';
$usuario='admin';
$pass='eSS)tIysDZbLT#%384tM';
$conexion = new mysqli($servidor, $usuario, $pass, $nombreBD);

if($conexion -> connect_error){
    die("no se pudo conectar a la base de datos");
}


?>