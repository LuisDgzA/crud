<?php
$usuario        = "root";
$password       = "";
$servidor       = "localhost";
$basededatos    = "coa";
$con            = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db             = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");

$email              = $_POST['email'];
$telefono           = $_POST['telefono'];
$id_analisis        = $_POST['id_analisis'];
$min                = $_POST['min'];
$max                = $_POST['max'];
$condiciones        = $_POST['condiciones'];
$envio              = $_POST['envio'];

/*function codAleatorio($length = 5) {
    return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$CODE_REFERENCIA  = codAleatorio();*/

for ($i=0; $i < count($id_analisis); $i++){ 
        $InsertData = "UPDATE proveedores 
        SET id_analisis = '$id_analisis[i]', min = '$min', max = '$max', condiciones = '$condiciones', envio = '$envio' 
        WHERE email = '$email'";
    $resultadoInsertUser = mysqli_query($con, $InserData);
  }

 header('Location: ../micro.php');

?>