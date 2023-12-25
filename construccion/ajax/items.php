<?php
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	if (isset($_REQUEST['id_tmp'])){
		$id=intval($_REQUEST['id_tmp']);
		$delete=mysqli_query($con,"delete from tmp where id_tmp='$id'");
	}
	
	if (isset($_POST['id_analisis'])){
		
		$id_analisis=intval($_POST['id_analisis']);
		$cantidad=intval($_POST['cantidad']);
		$unidad=intval($_POST['unidad']);
		$sql="INSERT INTO tmp( 'cantidad', 'unidad') VALUES ('$cantidad', '$unidad');";
		$insert=mysqli_query($con,$sql);
	}
	
	$query=mysqli_query($con,"select * from tmp order by id_tmp");
	$items=1;
	$suma=0;
	while($row=mysqli_fetch_array($query)){
			$total=$row['cantidad']*$row['unidad'];
		?>
	<tr>
		<td class='text-center'><?php echo $items;?></td>
		<td class='text-center'><?php echo $row['id_analisis'];?></td>
		<td class='text-center'><?php echo $row['cantidad'];?></td>
		<td class='text-center'><?php echo $row['unidad'];?></td>		
		<td class='text-right'><a href="#" onclick="eliminar_item('<?php echo $row['id']; ?>')" ><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAeFBMVEUAAADnTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDx+VWpeAAAAJ3RSTlMAAQIFCAkPERQYGi40TVRVVlhZaHR8g4WPl5qdtb7Hys7R19rr7e97kMnEAAAAaklEQVQYV7XOSQKCMBQE0UpQwfkrSJwCKmDf/4YuVOIF7F29VQOA897xs50k1aknmnmfPRfvWptdBjOz29Vs46B6aFx/cEBIEAEIamhWc3EcIRKXhQj/hX47nGvt7x8o07ETANP2210OvABwcxH233o1TgAAAABJRU5ErkJggg=="></a></td>
	</tr>	
		<?php
		$items++;
		$suma+=$total;
	}
	?>
	<tr>
		<td colspan='7'>		
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Agregar análisis</button>
		</td>
	</tr>
	<tr>
		
		<td></td>
	</tr>
<?php

}