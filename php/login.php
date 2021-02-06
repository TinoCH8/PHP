<?php
    session_start();

    include "./conexion.php";

    
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $resultado = $conexion -> query("select * from usuarios where email='$email' 
    and password='".sha1($pass)."'") or die ($conexion -> error);

    if(mysqli_num_rows($resultado) > 0){
        $fila = mysqli_fetch_row($resultado);
        $id = $fila[0];
        $nombre = $fila[1];
        $apellido = $fila[2];
        $email = $fila[3];
        $imagen = $fila[5];
       
        $array=array(
            'Id' => $id,
            'Nombre' => $nombre,
            'Ap' => $apellido,
            'Email' => $email,
            'Imagen' => $imagen
        );
            
        //echo json_encode($array);
            $_SESSION['uData']=$array;
           header("Location: ../index.php");
    
    }else{
        echo "LOGIN INCORRECTO";

    }







?>