
<?php

include "./conexion.php";

$nombre = $_POST['nom'];  
$ap = $_POST['ap'];  
$em = $_POST['email'];  
$p1 = $_POST['p1'];  
$p2 = $_POST['p2'];  

if($p1 != $p2){
    echo "el password es diferente";
    header("location: ../usuarios.php?error=los campos no coinciden");
}else{
    $p1=sha1($p1);
    $conexion->query(" insert into usuarios (nombre, apellido, email, password, img_perfil) values 
        ('$nombre','$ap','$em','$p1','default.jpg')") or die($conexion->error);
        header("Location: ./../usuarios.php");
    }
?>