
<?php

include "./conexion.php";

$nombre = $_POST['nom'];
$apellido = $_POST['ap'];
$email = $_POST['email'];
$pass1 = $_POST['p1'];
$pass2 = $_POST['p2'];
$id = $_POST['id'];

if(trim($pass1)=="" && trim($pass2)==""){

$conexion -> query("update usuarios set 
    nombre = '$nombre', 
    apellido= '$apellido', 
    email='$email' 
    where id=$id")
or die ($conexion -> error);

header("location: ../usuarios.php?success=Actualizado Correctamente"); 
}else{
    if($pass1 == $pass2){
        $pass = sha1($p1);
        $conexion -> query("update usuarios set nombre = '$nombre', apellido= '$apellido', email='$email', password='$pass' 
        where id=$id") or die ($conexion -> error);
        echo "se actualizo el pas";
        header("location: ../usuarios.php"); 
        header("location: ../usuarios.php?success=Actualizado Correctamente"); 
    }else{
        echo "No se actualizo el pas";
        header("location: ../usuarios.php?error=los campos no coinciden"); 
    }

}



?>