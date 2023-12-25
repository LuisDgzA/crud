<?php
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$query_perfil=mysqli_query($con,"select * from perfil where id=1");
	$rw=mysqli_fetch_assoc($query_perfil);
	$sql=mysqli_query($con, "select LAST_INSERT_ID(id) as last from ordenes order by id desc limit 0,1 ");
	$rws=mysqli_fetch_array($sql);
	$numero=1;
	if (isset($rws['last'])){
		$numero=$rws['last']+1;
	} 
	
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Script PHP para control de notas de gastos" />
    <meta name="author" content="Obed Alvarado" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Plantilla de orden de compra de construcción - <?php echo $rw['nombre_comercial'];?></title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->

    <link href="assets/css/style.css" rel="stylesheet" />
	<link rel=icon href='http://obedalvarado.pw/img/logo-icon.png' sizes="32x32" type="image/png">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
</head>
<body >
    <div class="container outer-section" >
	<div class="row pad-top font-big">
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <a href="https://obedalvarado.pw/" target="_blank">  <img src="assets/img/trophe.png" alt="Logo sistemas web" /></a>
                </div>
            </div>
        
			
<form action="recib.php" method="POST">
			<div class="row ">
				<hr />
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h2>Detalles del PT :</h2>
                     <select class="proveedor form-control" name="proveedor" id="proveedor" required>
						<option value="">Selecciona el PT</option>
					</select>
                    <span id="direccion"></span>
                    <h4><strong>PT: </strong><span id="email"></span></h4>
                    <h4><strong>Descripción: </strong><span id="telefono"></span></h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h2></h2>					
					<div class="row">
						<div class="col-lg-6">
						<label>Caducidad</label>
						<input type="date" name="condiciones" id="condiciones" class="form-control">
						</div>
						
						<div class="col-lg-6">
						<label>Empaque</label>
						<input type="text" name="envio" id="envio" class="form-control">
						</div>
						
					</div>                  
                </div>
            </div>
	<div class="row text-right">
		<div class="col-md-12">
			<button class="btn add-btn btn-info">+</button>
		</div>
	</div>

	<div class="form-row">
	<div class="col-md-4">
		<label>Análisis</label>
		<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="id_analisis[]" id="id_analisis[]" >
							<?php 
							include("../conexion.php");
							$query_rol = mysqli_query($conexion, "SELECT * FROM analisis");
							mysqli_close($conexion);
							$resultado_rol = mysqli_num_rows($query_rol);
							if ($resultado_rol > 0) {
								while ($rol = mysqli_fetch_array($query_rol)) {
							?>
									<option value="<?php echo $rol["id_analisis"]; ?>"><?php echo $rol["nombre_a"]  ?></option>
							<?php

								}
							}
						?>
		</select> 
	</div>

	<div class="col-md-4">
		<label>Mínimo</label>
		<input type="number" name="min" class="form-control">
	</div>

	<div class="col-md-4">
		<label>Máximo</label>
			<input type="number" name="max" class="form-control">
	</div>
	</div>

	<div class="newData"></div>
	<div class="row text-center mt-5">
	<div class="col-md-12">
	<input type="submit" class="btn btn-primary" value="Registrar"/>
	</div>
	</div>
	<br>
</form>
    </div>
	
   
</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
    $( ".proveedor" ).select2({        
    ajax: {
        url: "ajax/json.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
}).on('change', function (e){
		var email = $('.proveedor').select2('data')[0].email;
		var telefono = $('.proveedor').select2('data')[0].telefono;
		$('#email').html(email);
		$('#telefono').html(telefono);
})
});

	function mostrar_items(){
		var parametros={"action":"ajax"};
		$.ajax({
			url:'ajax/items.php',
			data: parametros,
			 beforeSend: function(objeto){
			 $('.items').html('Cargando...');
		  },
			success:function(data){
				$(".items").html(data).fadeIn('slow');
		}
		})
	}
	function eliminar_item(id){
		$.ajax({
			type: "GET",
			url: "ajax/items.php",
			data: "action=ajax&id="+id,
			 beforeSend: function(objeto){
				 $('.items').html('Cargando...');
			  },
			success: function(data){
				$(".items").html(data).fadeIn('slow');
			}
		});
	}
	
	$( "#guardar_item" ).submit(function( event ) {
		parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url:'ajax/items.php',
			data: parametros,
			 beforeSend: function(objeto){
				 $('.items').html('Cargando...');
			  },
			success:function(data){
				$(".items").html(data).fadeIn('slow');
				$("#myModal").modal('hide');
			}
		})
		
	  event.preventDefault();
	})
	$("#datos_presupuesto").submit(function(){
		  var proveedor = $("#proveedor").val();
		  var condiciones = $("#condiciones").val();
		  var envio = $("#envio").val();
		 
		  
		  if (proveedor>0)
		 {
			VentanaCentrada('./pdf/documentos/orden.php?proveedor='+proveedor+'&condiciones='+condiciones+'&envio='+envio,'Orden','','1024','768','true');	
		 } else {
			 alert("Selecciona el proveedor");
			 return false;
		 }
		 
	 });
		

		mostrar_items();
		
		
</script>
	<script type="text/javascript">

		$(function () { 
		var i = 1;
		$('.add-btn').click(function (e) {
			e.preventDefault();
			i++;

			$('.newData').append('<div id="newRow'+i+'" class="form-row">'
				+'<div class="col-md-4">'
				+'<label>Análisis</label>'
				+'<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="id_analisis" id="id_analisis" >'				
				+'</select>'
				+'</div>'
				+'<div class="col-md-4">'
				+'<label>Mínimo</label>'
				+'<input type="number" name="min[]" class="form-control">'
				+'</div>'
				+'<div class="col-md-4">'
				+'<label>Máximo</label>'
				+'<input type="number" name="max[]" class="form-control">'
				+'</div>'
				+'<a href="#" class="remove-lnk" id="'+i+'">Eliminar "'+i+'"</a>'
				+'</div>'
			);  
		});
	

		$(document).on('click', '.remove-lnk', function(e) {
			e.preventDefault();

			var id = $(this).attr("id");
			$('#newRow'+id+'').remove();
			});
	
		});
	</script>
</html>
