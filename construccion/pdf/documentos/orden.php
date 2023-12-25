<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	 ob_start();
	session_start();
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	$session_id= session_id();
	$sql_count=mysqli_query($con,"select * from tmp ");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados a la orden')</script>";
	echo "<script>window.close();</script>";
	exit;
	}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
	$proveedor=intval($_GET['proveedor']);
	$condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
	$envio=mysqli_real_escape_string($con,(strip_tags($_REQUEST['envio'], ENT_QUOTES)));
	

	//Fin de variables por GET
	$sql=mysqli_query($con, "select LAST_INSERT_ID(id) as last from ordenes order by id desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$numero=1;
	if (isset($rw['last'])){
		$numero=$rw['last']+1;
	}
		
	$perfil=mysqli_query($con,"select * from perfil limit 0,1");//Obtengo los datos de la emprea
	$rw_perfil=mysqli_fetch_array($perfil);
	
	$sql_cliente=mysqli_query($con,"select * from proveedores where id='$proveedor' limit 0,1");//Obtengo los datos del proveedor
	$rw_cliente=mysqli_fetch_array($sql_cliente);
    // get the HTML
	
    
     include(dirname('__FILE__').'/res/orden_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('orden.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
