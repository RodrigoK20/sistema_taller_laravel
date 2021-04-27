<style>

@import url('../fonts/BrixSansRegular.css');
@import url('../fonts/BrixSansBlack.css');

*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}
p, label, span, table{
	font-family: 'BrixSansRegular';
	font-size: 9pt;
}
.h2{
	font-family: 'BrixSansBlack';
	font-size: 16pt;
}
.h3{
	font-family: 'BrixSansBlack';
	font-size: 12pt;
	display: block;
	background: #0a4661;
	color: #FFF;
	text-align: center;
	padding: 3px;
	margin-bottom: 5px;
}
#page_pdf{
	width: 95%;
	margin: 15px auto 10px auto;
}

#factura_head, #factura_cliente, #factura_detalle{
	width: 100%;
	margin-bottom: 10px;
}
.logo_factura{
	width: 25%;
}
.info_empresa{
	width: 50%;
	text-align: center;
}
.info_factura{
	width: 25%;
}
.info_cliente{
	width: 100%;
}
.datos_cliente{
	width: 100%;
}
.datos_cliente tr td{
	width: 50%;
}
.datos_cliente{
	padding: 10px 10px 0 10px;
}
.datos_cliente label{
	width: 75px;
	display: inline-block;
}
.datos_cliente p{
	display: inline-block;
}

.textright{
	text-align: right;
}

.textleft{
	text-align: left;
}
.textcenter{
	text-align: center;
}
.round{
	border-radius: 10px;
	border: 1px solid #0a4661;
	overflow: hidden;
	padding-bottom: 15px;
}
.round p{
	padding: 0 15px;
}

#factura_detalle{
	border-collapse: collapse;
}
#factura_detalle thead th{
	background: #E32900;
	color: #FFF;
	padding: 5px;
	padding-right: 60px;
}
#detalle_productos tr:nth-child(even) {
    background: #ededed;
}
#detalle_totales span{
	font-family: 'BrixSansBlack';
}
.nota{
	font-size: 8pt;
}
.label_gracias{
	font-family: verdana;
	font-weight: bold;
	font-style: italic;
	text-align: center;
	margin-top: 20px;
}
.anulada{
	position: absolute;
	left: 50%;
	top: 50%;
	transform: translateX(-50%) translateY(-50%);
}

.cantidad {
	
}

.table-striped tbody tr:nth-child(odd) {
  background: #eee;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Cotización Cliente: {{$client->name}}</title>
 

	<!-- jQuery -->
<!-- <script src="../js/jquery.min.js"></script> -->

</head>
<body>

<div id="page_pdf">
	<table id="factura_head" >
		<tr>
			<td class="logo_factura">
				<div>
					<!-- <img src="public/image/{{$business->logo}}" class="brand-image img-circle elevation-3" alt="logo" width="125" height="125"> -->
					<img src="{{ public_path().'/image/'.$business->logo }}" class="brand-image img-circle elevation-3" alt="logo" width="125" height="125" />
				</div>
			</td>
			<td class="info_empresa">
				<div>
					<span class="h2">{{$business->name}}</span>
					<p>Dirección: {{$business->address}}</p>
					<p>Teléfono: {{$business->phone}}</p>
					<p>Correo: {{$business->mail}}</p>
				</div>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3">Cotización</span>
					<p>No. Cotización: {{$cot->id}}<strong></strong></p>
					<p>Cliente: {{$client->name}} </p>
					<p>Fecha: {{$cot->date}} </p>
				
				</div>
			</td>
		</tr>
	</table>


	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Vehículo</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Marca:</label><p>{{$car->brand}}</p></p></td>
							<td><label>Modelo:</label> <p>{{$car->model}}</p></td>
						</tr>
						<tr>
							<td><label>Año:</label><p>{{$car->year}}</p></p></td>
							<td><label>Placa:</label> <p>{{$car->license_plate}}</p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<p><strong>Detalle Cotización</strong></p>
	<br>

	<table id="factura_detalle" class="table-striped">
			<thead>
				<tr>
					<th width="120px">Producto</th>
					<th class="center" width="125px">Cantidad</th>
					<th class="center" width="120px">Precio Unitario ($)</th>
					<th class="center" width="135px">Subtotal $</th>
					
				</tr>
			</thead>

			@foreach ($cotizacionDetails as $cotizacionDetail)
			<tbody id="detalle_productos">

			<tr>
			
			<td class="">{{$cotizacionDetail->product}}</td>
			<td class="textcenter">{{$cotizacionDetail->quantity}}</td>
			<td class="textcenter">${{$cotizacionDetail->price}}</td>
			<td class="textcenter"> ${{number_format($cotizacionDetail->quantity*$cotizacionDetail->price,2)}}</td>
	

			</tr>
			
			@endforeach
			</tbody>
			
		<br>
		<br>
			<tfoot id="detalle_totales">
				
				<tr>
					<td colspan="3" class="textright" style="padding-bottom: 10px;"><strong><span>TOTAL:</span></strong></td>
					<td class="textright" style="padding-bottom: 9px;"><strong><span>$ {{number_format($cot->total,2)}} </span></strong></td>
				</tr>
		</tfoot>
	</table>


	<div>
		<p class="nota">Si usted tiene preguntas sobre esta cotización, <br>con gusto puede ponerse en contacto con nosotros.</p>
		<h4 class="label_gracias">¡Gracias por su preferencia!</h4>

		@if($cot->id > 0)

		<div class="label_gracias">
	
		</div>
		@else

		@endif

	</div>

</div>



</body>
</html>



