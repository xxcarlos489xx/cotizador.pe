
<div class="col-md-12">
	<h2><span class="glyphicon glyphicon-edit"></span> Nueva Cotización</h2>
	<hr>
	<form class="form-horizontal" role="form" id="datos_cotizacion">
		<div class="form-group row">
			<label for="atencion" class="col-md-1 control-label">Atención:</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="atencion" placeholder="Proforma" required>
			</div>
			<label for="tel1" class="col-md-1 control-label">Teléfono:</label>
			<div class="col-md-2">
				<input type="text" class="form-control" id="tel1" placeholder="Teléfono" required>
			</div>
		</div>
		<div class="form-group row">
			<label for="empresa" class="col-md-1 control-label">Empresa:</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="empresa" placeholder="Nombre de la empresa">
			</div>
			<label for="tel2" class="col-md-1 control-label">Nro. RUC:</label>
			<div class="col-md-2">
				<input type="text" class="form-control" id="tel2" placeholder="Ingrese número">
			</div>
			<label for="email" class="col-md-1 control-label">Email:</label>
			<div class="col-md-3">
				<input type="email" class="form-control" id="email" placeholder="Email">
			</div>
		</div>


		<div class="col-md-12">
			<div class="pull-right">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
					<span class="glyphicon glyphicon-plus"></span> Agregar productos
				</button>
				<button type="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-print"></span> Imprimir
				</button>
			</div>	
		</div>
	</form>
	<br><br>
	<div id="resultados" class='col-md-12'></div><!-- Carga los datos ajax -->

	<!-- Modal -->
	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-6">
								<input type="text" class="form-control" id="q" placeholder="Buscar productos" onkeyup="load(1)">
							</div>
							<button type="button" class="btn btn-default" onclick="load(1)"><span class='glyphicon glyphicon-search'></span> Buscar</button>
						</div>
					</form>
					<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="outer_div" ></div><!-- Datos ajax Final -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		load(1);
	});

	function load(page){
		var q= $("#q").val();
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'./ajax/productos_cotizacion.php?action=ajax&page='+page+'&q='+q,
			beforeSend: function(objeto){
				$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				console.log(data);
				$(".outer_div").html(data).fadeIn('slow');
				$('#loader').html('');
				
			}
		})
	}
</script>
<script>
	function agregar (id)
	{
		var precio_venta=document.getElementById('precio_venta_'+id).value;
		var cantidad=document.getElementById('cantidad_'+id).value;
		//Inicia validacion
		if (isNaN(cantidad))
		{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
		}
		if (isNaN(precio_venta))
		{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
		}
		//Fin validacion
		
		$.ajax({
			type: "POST",
			url: "./ajax/agregar_cotizador.php",
			data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
			beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#resultados").html(datos);
			}
		});
	}
	
	function eliminar (id)
	{
		$.ajax({
			type: "GET",
			url: "./ajax/agregar_cotizador.php",
			data: "id="+id,
			beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#resultados").html(datos);
			}
		});
	}
	
	$("#datos_cotizacion").submit(function(){
		var atencion = $("#atencion").val();
		var tel1 = $("#tel1").val();
		var empresa = $("#empresa").val();
		var tel2 = $("#tel2").val();
		var email = $("#email").val();
		var condiciones = $("#condiciones").val();
		var validez = $("#validez").val();
		var entrega = $("#entrega").val();
		var observaciones = $("#observaciones").val();

		VentanaCentrada('./pdf/documentos/cotizacion_pdf.php?atencion='+atencion+'&tel1='+tel1+'&empresa='+empresa+'&tel2='+tel2+'&email='+email+'&condiciones='+condiciones+'&validez='+validez+'&entrega='+entrega+'&observaciones='+observaciones,'Cotizacion','','1024','768','true');
	});
</script>
