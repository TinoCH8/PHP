<?php
    include "./conexion.php";
    $nombre = $_POST['nom'];
    $precio = $_POST['precio'];
    $inve = $_POST['inventario'];
    $nombreIMG = $_FILES['imagen']['name'];

    $temp = explode(".", $nombreIMG);
    $extencion = end($temp);
    $nombreFinal = (time().".".$extencion);
    if($extencion == 'jpg' || $extencion == 'png'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], "../img/product/".$nombreFinal ) ){
            
            $conexion -> query("
            insert into productos (nombre, precio, inventario, imagen) values ('$nombre',$precio,$inve,'$nombreFinal')")
             or die ($conexion -> error);

            header("location: ../productos.php?success=archivo subido correctamente");

        }else{
            header("location: ../productos.php?error=ocurrio un error al subir la imagen");

        }


    }else{
         header("location: ../productos.php?error=tipo de archivo no valido");

    }
    
    die ( );
    