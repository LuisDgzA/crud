<?php
include("../conexion.php");
if(isset($_POST['semana']) && isset($_POST['id_lote']) && isset($_POST['meso']) && isset($_POST['coli'])&& isset($_POST['hon'])&& 
isset($_POST['leva'])&& isset($_POST['estatus'])&&isset($_POST['com']))
{
    // include Database connection file 
    include("../conexion.php");

    // get values 
    $semana = $_POST['semana'];
    $id_lote = $_POST['id_lote'];    	
    $meso = $_POST['meso'];
    $coli = $_POST['coli'];
    $hon = $_POST['hon'];
    $leva = $_POST['leva'];
    $estatus = $_POST['estatus'];
    $com = $_POST['com'];
    

    $query = "INSERT INTO micro(semana,fecha,id_lote,meso,coli,hon,leva,estatus,com) 
    VALUES('$semana',SYSDATE(),'$id_lote','$meso','$coli','$hon','$leva','$estatus','$com')";
    if (!$result = mysqli_query($conexion, $query)) {
        exit(mysqli_error($conexion));
    }
    echo '<script language="javascript">alert("Análisis añadidos con éxito!");</script>';
    header('location: ../nuevo.php');
}
?>