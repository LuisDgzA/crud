<?php
include("../conexion.php");
if(isset($_POST['lote']) && isset($_POST['id_pt']))
{
    // include Database connection file 
    include("../conexion.php");

    // get values 
    $lote = $_POST['lote'];
    $id_pt = $_POST['id_pt'];   
    

    $query = "INSERT INTO lote(lote,id_pt) 
    VALUES('$lote','$id_pt')";
    if (!$result = mysqli_query($conexion, $query)) {
        exit(mysqli_error($conexion));
    }
    echo '<script language="javascript">alert("Lote añadido con éxito!");</script>';
    header('location: ../lotes.php');
}
?>