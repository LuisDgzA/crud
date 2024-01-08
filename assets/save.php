<?php
    // include Database connection file 
    include("../conexion.php");

    // get values 
    $_POST = json_decode(file_get_contents('php://input'), true);
    $lote = $_POST['lote']; $estatus = $_POST['estatus']; $comentarios = $_POST['comentarios'];
    foreach($_POST['arregloResultados'] as $resultado){
        $proveedor_analisis_id = $resultado['id_proveedor_analisis']; 
        $res_val = $resultado['valorResultado'];
        try {
            $insert_resultado = "INSERT INTO proveedor_resultado(proveedor_analisis_id, lote, resultado, estatus, comentarios) VALUES($proveedor_analisis_id, '$lote', '$res_val', '$estatus', '$comentarios');"; 
            $resultado_insert = mysqli_query($conexion, $insert_resultado);
        } catch (\Throwable $th) {
            // throw $th;
            echo json_encode(['success' => false, 'error' => $th]);
        }
    }

    if($resultado_insert) echo json_encode(['success' => true]);
    else echo json_encode(['success' => false, 'error' => 'No se agregó el resultado de análisis']);
    
               
    //     $query1 = "INSERT INTO p_hum(minh,maxh,ehum) VALUES('$minh','$maxh','$ehum')";
    //     $query = "INSERT INTO claves(clave_pt,pt,caducidad,empaque) VALUES('$clave_pt','$pt','$caducidad','$empaque')";
    //     if (!$result = mysqli_query($conexion, $query)) {
    //         exit(mysqli_error($conexion));
        
    //     }
    //     echo '<script language="javascript">alert("PT añadido con éxito!");</script>';
    //     header('location: ../lotes.php');
?>