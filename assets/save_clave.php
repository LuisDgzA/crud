<?php
include("../conexion.php");

    // get values 
    $clave_pt = $_POST['clave_pt'];
    $pt = $_POST['pt'];    	
    $caducidad = $_POST['caducidad'];
    $empaque = $_POST['empaque'];
    $ehum = $_POST['ehum'];
    $minh = $_POST['minh'];
    $maxh = $_POST['maxh'];
    $eme = $_POST['eme'];
    $eg8 = $_POST['eg8'];
    $e30 = $_POST['e30'];
    $efo = $_POST['efo'];
    $eph = $_POST['eph'];
    
   
        $query = "INSERT INTO claves(clave_pt,pt,caducidad,empaque) VALUES('$clave_pt','$pt','$caducidad','$empaque')";
    
        if (!$result = mysqli_query($conexion, $query)) {
            exit(mysqli_error($conexion));

            echo '<script language="javascript">alert("PT añadido con éxito!");</script>';
            header('location: ../lotes.php');

        }
        echo '<script language="javascript">alert("PT añadido con éxito!");</script>';
            header('location: ../lotes.php');