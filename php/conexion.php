
<?php
/* tecnologytiendach88.000webhostapp.com
 tecnologytiendach88.000webhostapp.com
 tecnologytiendach88.000webhostapp.com
 tecnologytiendach88.000webhostapp.com
 tecnologytiendach88.000webhostapp.com
 */
$servidor='localhost';
$nombreBD='id16099333_tiendatecnologych88';
$usuario='id16099333_admin';
$pass='eSS)tIysDZbLT#%384tM';
$conexion = new mysqli($servidor, $usuario, $pass, $nombreBD);

if($conexion -> connect_error){
    die("no se pudo conectar a la base de datos");
}


?>