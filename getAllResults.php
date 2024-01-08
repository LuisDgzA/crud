<?php
    include("conexion.php");

    try {
        $getResults = "SELECT proveedor_resultado.id, proveedor_resultado.lote, proveedor_analisis.proveedor_id, proveedores.email, proveedores.telefono
                        FROM `proveedor_resultado`
                        INNER JOIN proveedor_analisis ON proveedor_analisis.id = proveedor_resultado.proveedor_analisis_id
                        INNER JOIN proveedores ON proveedores.id = proveedor_analisis.proveedor_id
                        GROUP BY lote;";
        $query = mysqli_query($conexion, $getResults);
        $arrayRes = array();
        while ($obj = mysqli_fetch_object($query)){
            $arrayRes[] = $obj;
        }
        echo json_encode(['success' => true, 'respuesta' => $arrayRes]);
    } catch (\Throwable $th) {
        echo json_encode(['success' => false, 'error' => $th]);
    }
?>