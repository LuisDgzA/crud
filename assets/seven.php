<?php
    // include Database connection file 
    include("../conexion.php");

    // get values 
    $nombre_a = $_POST['nombre_a'];
    $categoria = $_POST['categoria'];    
    
               
        $query = "INSERT INTO analisis(nombre_a,categoria) VALUES('$nombre_a','$categoria')";
        if (!$result = mysqli_query($conexion, $query)) {
            exit(mysqli_error($conexion));
        
        }
        echo '<script language="javascript">alert("Análisis añadido con éxito!");</script>';
        header('location: ../new.php');
?>