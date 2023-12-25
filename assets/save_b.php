<?php
include("../conexion.php");
if(isset($_POST['id_lote']) && isset($_POST['partida']) && isset($_POST['h9m']) && isset($_POST['rm10'])&& isset($_POST['rm30'])&& 
isset($_POST['f20'])&& isset($_POST['ap_gr'])&&isset($_POST['sabor'])&&isset($_POST['olor'])&&isset($_POST['color'])&&isset($_POST['mat_ext'])&&
isset($_POST['analizo'])&&isset($_POST['libero'])&&isset($_POST['observaciones']))
{
    // include Database connection file 
    include("../conexion.php");

    // get values     
    $id_lote = $_POST['id_lote'];    	
    $partida = $_POST['partida'];
    $h9m = $_POST['h9m'];
    $rm10 = $_POST['rm10'];
    $rm30 = $_POST['rm30'];
    $f20 = $_POST['f20'];
    $ap_gr = $_POST['ap_gr'];
    $sabor = $_POST['sabor'];
    $olor = $_POST['olor'];
    $color = $_POST['color'];
    $mat_ext = $_POST['mat_ext'];
    $analizo = $_POST['analizo'];
    $libero = $_POST['libero'];
    $observaciones = $_POST['observaciones'];
    
    $query = "INSERT INTO bitacora(fecha, id_lote, partida, h9m, rm10, rm30, f20, ap_gr, sabor, olor, color, mat_ext, analizo, libero, observaciones) 
    VALUES(SYSDATE(),'$id_lote','$partida','$h9m','$rm10','$rm30','$f20','$ap_gr','$sabor','$olor','$color','$mat_ext','$analizo','$libero','$observaciones')";
    if (!$result = mysqli_query($conexion, $query)) {
        exit(mysqli_error($conexion));
    }
    echo '<script language="javascript">alert("Análisis añadidos con éxito!");</script>';
    header('location: ../f_o.php');
   
}
?>