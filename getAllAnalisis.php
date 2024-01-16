<?php
$usuario        = "root";
$password       = "";
$servidor       = "localhost";
$basededatos    = "coa";
$con            = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db             = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");

$_POST = json_decode(file_get_contents('php://input'), true);
$id_pt = $_POST['id_pt']; 

// var_dump($id_pt);

try {
    $getAnalisis = "SELECT pa.id AS id_proveedor_analisis, a.nombre_a AS analisis, pa.minimo AS min, pa.maximo AS max, pa.fecha_registro, pa.texto 
                    FROM proveedor_analisis pa
                    INNER JOIN analisis a ON pa.analisis_id = a.id_analisis
                    WHERE proveedor_id = $id_pt
                    AND pa.fecha_registro = (SELECT fecha_registro FROM proveedor_analisis
                                             WHERE proveedor_id = $id_pt
                                             ORDER BY fecha_registro DESC LIMIT 1)";
    $query = mysqli_query($con, $getAnalisis);
    // $data = mysqli_fetch_array($query);
    $arrayRes = array();
    while ($obj=mysqli_fetch_object($query)){
        $arrayRes[] = $obj;
    }
    echo json_encode(['success' => true, 'respuesta' => $arrayRes]);
    // if($res_update_prov) echo json_encode(['success' => true]);
    // else echo json_encode(['success' => false, 'error' => 'No se actualizó el registro proveedor']);
} catch (\Throwable $th) {
    //throw $th;
    echo json_encode(['success' => false, 'error' => $th]);
}

// foreach ($allAnalisis as $analisis) {
//     $analisis_id = $analisis['id_analisis']; $minimo = $analisis['minValue']; $maximo = $analisis['maxValue'];
//     try {
//         $insert_analisis = "INSERT INTO proveedor_analisis (proveedor_id, analisis_id, minimo, maximo) 
//                             VALUES('$proveedor_id', '$analisis_id', '$minimo', '$maximo');";
//         $resultadoInsertUser = mysqli_query($con, $insert_analisis);
//     } catch (\Throwable $th) {
//         //throw $th;
//         echo json_encode(['success' => false, 'error' => $th]);
//     }
// }

// $update_proveedor = "UPDATE proveedores 
//                 SET condiciones = '$condiciones', envio = '$envio' 
//                 WHERE id = '$proveedor_id'";
// $res_update_prov = mysqli_query($con, $update_proveedor);

// if($res_update_prov) echo json_encode(['success' => true]);
// else echo json_encode(['success' => false, 'error' => 'No se actualizó el registro proveedor']);




?>