<?php
$usuario        = "root";
$password       = "";
$servidor       = "localhost";
$basededatos    = "coa";
$con            = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db             = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");

$_POST = json_decode(file_get_contents('php://input'), true);
$proveedor_id = $_POST['proveedor']; 
$condiciones = $_POST['condiciones']; 
$envio = $_POST['envio']; 
$allAnalisis = $_POST['allAnalisis'];
foreach ($allAnalisis as $analisis) {
    $analisis_id = $analisis['id_analisis']; $minimo = $analisis['minValue']; $maximo = $analisis['maxValue'];
    try {
        $insert_analisis = "INSERT INTO proveedor_analisis (proveedor_id, analisis_id, minimo, maximo, fecha_registro, fecha_caducidad, empaque) 
                            VALUES('$proveedor_id', '$analisis_id', '$minimo', '$maximo',NOW(), '$condiciones', '$envio');";
        $resultadoInsertUser = mysqli_query($con, $insert_analisis);
    } catch (\Throwable $th) {
        //throw $th;
        echo json_encode(['success' => false, 'error' => $th]);
    }
}

$update_proveedor = "UPDATE proveedores 
                SET condiciones = '$condiciones', envio = '$envio' 
                WHERE id = '$proveedor_id'";
$res_update_prov = mysqli_query($con, $update_proveedor);

if($res_update_prov) echo json_encode(['success' => true]);
else echo json_encode(['success' => false, 'error' => 'No se actualizó el registro proveedor']);


/*function codAleatorio($length = 5) {
    return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$CODE_REFERENCIA  = codAleatorio();*/

// for ($i=0; $i < count($id_analisis); $i++){ 
//         $InsertData = "UPDATE proveedores 
//         SET id_analisis = '$id_analisis[i]', min = '$min', max = '$max', condiciones = '$condiciones', envio = '$envio' 
//         WHERE email = '$email'";
//     $resultadoInsertUser = mysqli_query($con, $InserData);
//   }

//  header('Location: ../micro.php');

?>