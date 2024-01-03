<?php
    include("conexion.php");

    try {
        $getResults = "SELECT proveedor_resultado.id, proveedor_resultado.lote, proveedor_analisis.proveedor_id, proveedores.email, proveedores.telefono
                        FROM `proveedor_resultado`
                        INNER JOIN proveedor_analisis ON proveedor_analisis.id = proveedor_resultado.proveedor_analisis_id
                        INNER JOIN proveedores ON proveedores.id = proveedor_analisis.proveedor_id;";
        $query = mysqli_query($conexion, $getResults);
        // $data = mysqli_fetch_array($query);
        $arrayRes = array();
        while ($obj = mysqli_fetch_object($query)){
            $arrayRes[] = $obj;
        }
        echo json_encode(['success' => true, 'respuesta' => $arrayRes]);
        // if($res_update_prov) echo json_encode(['success' => true]);
        // else echo json_encode(['success' => false, 'error' => 'No se actualizó el registro proveedor']);
    } catch (\Throwable $th) {
        //throw $th;
        echo json_encode(['success' => false, 'error' => $th]);
    }
?>