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
	$data_select = "";
	include("../conexion.php");
	$query_rol = mysqli_query($conexion, "SELECT * FROM analisis");
	mysqli_close($conexion);
	$resultado_rol = mysqli_num_rows($query_rol);
	if ($resultado_rol > 0) {
		while ($rol = mysqli_fetch_array($query_rol)) {									
			$data_select .= "<option value=".$rol['id_analisis'].">".$rol["nombre_a"]."</option>";					

		}
	}
								// var_dump($data_select);
							
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body >
    <div class="container outer-section" >
	<div class="row pad-top font-big">
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <a href="https://obedalvarado.pw/" target="_blank">  <img src="assets/img/trophe.png" alt="Logo sistemas web" /></a>
                </div>
            </div>
        
			
<form id="formPT" method="POST">
	<div class="row ">
		<hr />
		<div class="col-lg-4 col-md-4 col-sm-4">
			<h2>Detalles del PT :</h2>
				<select class="proveedor form-control" name="proveedor" id="proveedor" required>
				<option value="">Selecciona el PT</option>
			</select>
			<span id="direccion"></span>
			<h4><strong>PT: </strong><span id="email"></span></h4>
			<h4><strong>Descripción: </strong><span id="telefono"></span></h4>
		</div>
		<div class="col-lg-8 col-md-6 col-sm-6">
			<h2></h2>					
			<div class="row">
				<div class="col-lg-4">
					<label for="">&nbsp;</label>
					<select class="form-control" name="" id="mesesCaducidad">
						<option value="">Seleccione una opción</option>
						<option value="1">6 meses</option>
						<option value="9">9 meses</option>
						<option value="12">12 meses</option>
						<option value="18">18 meses</option>
					</select>
				</div>
				<div class="col-lg-4">
					<label>Caducidad</label>
					<input type="date" name="condiciones" id="condiciones" class="form-control" required>
				</div>
				
				<div class="col-lg-4">
					<label>Empaque</label>
					<input type="text" name="envio" id="envio" class="form-control" required>
				</div>
				
			</div>                  
		</div>
	</div>
	<div class="row text-right">
		<div class="col-md-12">
			<button class="btn add-btn btn-info">+</button>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<label>Análisis</label>
			<select class="form-control select2 select2-danger select-analisis" data-dropdown-css-class="select2-danger" style="width: 100%;" name="id_analisis[]" id="id_analisis[]" required>
								<?php 
								echo($data_select);
								
							?>
			</select> 
		</div>

		<div class="col-md-4">
			<label>Mínimo</label>
			<input type="number" step="any" name="min[]" class="form-control inp-min" required>
		</div>

		<div class="col-md-4">
			<label>Máximo</label>
			<input type="number" step="any" name="max[]" class="form-control inp-max" required>
		</div>
	</div>

	<div class="newData"></div>
	<div class="row text-center mt-5" style="margin-top: 1rem;">
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

	let mesesCaducidad = document.getElementById("mesesCaducidad")
	mesesCaducidad.addEventListener("change",() => {
		// console.log(mesesCaducidad.value)
		let currentDate = new Date();
		let fechaCaducidad = new Date();
		let condiciones = document.getElementById("condiciones")
		fechaCaducidad.setMonth(currentDate.getMonth()+mesesCaducidad.value)
		condiciones.value = fechaCaducidad.getFullYear()+"-"+(fechaCaducidad.getMonth()+1).toString().padStart(2, "0")+"-"+fechaCaducidad.getDate().toString().padStart(2, "0");
		// console.log(fechaCaducidad.getFullYear()+"-"+(fechaCaducidad.getMonth()+1).toString().padStart(2, "0")+"-"+fechaCaducidad.getDate().toString().padStart(2, "0"))
		// console.log(fechaCaducidad)

	})

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
	$(document).on("submit","#formPT", async function(e){
		e.preventDefault();
		let parametros = $(this).serializeArray();

		let proveedor = document.getElementById("proveedor").value
		,condiciones = document.getElementById("condiciones").value
		,envio = document.getElementById("envio").value
		,totalRows = document.querySelectorAll('.select-analisis')
		,selectAnalisis = document.querySelectorAll('.select-analisis')
		,minValues = document.querySelectorAll('.inp-min')
		,maxValues = document.querySelectorAll('.inp-max')
		,analisisArray = []
		,minValuesArray = []
		,maxValuesArray = [],
		allAnalisis = []


		totalRows.forEach((row,index) => {
			allAnalisis[index] = {
				id_analisis: selectAnalisis[index].value,
				minValue: minValues[index].value,
				maxValue: maxValues[index].value
			}
			// analisisArray.push(selectAnalisis[index])
			
			


		})

		


		let datos = {
			proveedor,
			condiciones,
			envio,
			allAnalisis
		}
		console.log("datos",datos)

		let res = await fetch("./recib.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify(datos),
		})
		let response = await res.json();
		if(response.success){
			$("#formPT")[0].reset();
			Swal.fire({
				title: "Datos guardados",
				text: "",
				icon: "success"
			}).then((result) => {
				if (result) {
					
					window.location.href = "../micro.php";
				}
			});
		}else{
			alert("Algo salió mal durante el guardado de datos");

		}

		// console.log("parametros",parametros)
		// console.log(JSON.parse(JSON.stringify(parametros)))
		// alert("xd")
	})
	// $( "#formPT" ).submit(function( event ) {
	// 	event.preventDefault();
	// 	parametros = $(this).serialize();
	// 	console.log("parametros",parametros)
	// 	// $.ajax({
	// 	// 	type: "POST",
	// 	// 	url:'ajax/items.php',
	// 	// 	data: parametros,
	// 	// 	 beforeSend: function(objeto){
	// 	// 		 $('.items').html('Cargando...');
	// 	// 	  },
	// 	// 	success:function(data){
	// 	// 		$(".items").html(data).fadeIn('slow');
	// 	// 		$("#myModal").modal('hide');
	// 	// 	}
	// 	// })
		
	// })
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
	let data_select = "<?= $data_select ?>";
	// console.log(data_select)
	$(function () { 
	var i = 1;
	$('.add-btn').click(function (e) {
		e.preventDefault();
		i++;

		$('.newData').append(`
			<div class="row" style="display: flex; align-items: end; margin-top: 1rem;">
				<div class="col-md-4">
					<label>Análisis</label>
					<select class="form-control select2 select2-danger select-analisis" data-dropdown-css-class="select2-danger" style="width: 100%;" name="id_analisis[]" id="id_analisis[]"  required>
						${data_select}		
					</select> 
				</div>

				<div class="col-md-3">
					<label>Mínimo</label>
					<input type="number" step="any" name="min[]" class="form-control inp-min" required>
				</div>

				<div class="col-md-3">
					<label>Máximo</label>
					<input type="number" step="any" name="max[]" class="form-control inp-max" required>
				</div>

				<div class="col-md-2">					
					<button class="btn btn-danger btn-remover">Remover</button>
				</div>
			</div>
		`);  
	});

	$(document).on("click", ".btn-remover", function(){
		let row_item = $(this).parent().parent();
		$(row_item).remove();
	})


	$(document).on('click', '.remove-lnk', function(e) {
		e.preventDefault();

		var id = $(this).attr("id");
		$('#newRow'+id+'').remove();
		});

	});
</script>
</html>
