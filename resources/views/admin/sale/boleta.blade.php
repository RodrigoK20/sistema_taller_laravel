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
	<title>Factura Cliente: {{$client->name}}</title>
 

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
					<span class="h3">Factura Cliente: {{$client->name}} </span>
					<p>No. Factura: {{$sale->id}}<strong></strong></p>
					<p>Fecha: {{$sale->sale_date}} </p>
					<p>Vendedor: {{$user->name}} </p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>DUI:</label><p>{{$client->dui}}</p></p></td>
							<td><label>Teléfono:</label> <p>{{$client->phone}}</p></td>
						</tr>
						<tr>
							<td><label>Nombre:</label><p>{{$client->name}}</p></p></td>
							<td><label>Dirección:</label> <p>{{$client->address}}</p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<p><strong>Detalle Productos</strong></p>
	<br>

	<table id="factura_detalle" class="table-striped">
			<thead>
				<tr>
					<th width="90px">Producto</th>
					<th class="center" width="90px">Cantidad</th>
					<th class="center" width="90px">Precio Venta ($)</th>
					<th class="center" width="90px">Descuento %</th>
					<th class="center" width="70px">Subtotal $</th>
					
				</tr>
			</thead>

			@foreach ($saleDetails as $saleDetail)
			<tbody id="detalle_productos">

			<tr>
			
			<td class="textcenter">{{$saleDetail->product->name}}</td>
			<td class="textcenter">{{$saleDetail->quantity}}</td>
			<td>${{$saleDetail->price}}</td>
			<td class="textcenter">{{$saleDetail->discount}}</td>
			<td>${{number_format($saleDetail->quantity*$saleDetail->price - $saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100,2)}}</td>
	

			</tr>
			
			@endforeach
			</tbody>
			
		
			<tfoot id="detalle_totales">
				
				<tr>
					<td colspan="4" class="textright" style="padding-top: 20px;"><strong><span>IVA ({{$sale->tax}}%)</strong></span></td>
					<td class="textright" style="padding-top: 14px;"><strong><span>$ {{number_format($subtotal*$sale->tax/100,2)}} </strong></span></td>
			
				</tr>
				<tr>
					<td colspan="4" class="textright" style="padding-bottom: 10px;"><strong><span>TOTAL</span></strong></td>
					<td class="textright" style="padding-bottom: 9px;"><strong><span>$ {{number_format($sale->total,2)}} </span></strong></td>
				</tr>
		</tfoot>
	</table>

	<p><strong>Repuestos</strong></p>
	<br>
	<!-- Tabla Repuestos Gastos -->
	<table id="factura_detalle" class="table-striped">
			<thead>
				<tr>
					<th width="20px" style="text-align:center">Repuesto</th>
					<th class="center" width="140px">Precio</th>
					<th class="center" width="135px">Cantidad</th>
					<th class="center" width="140px">Subtotal ($)</th>	
				</tr>
			</thead>

			 @foreach($gastosDetails as $gastoDetail)
                 <tr>
				 	<td style="text-align:center">{{$gastoDetail->name_product}}</td>
                      <td style="text-align:center">${{$gastoDetail->price}}</td>
                      <td style="text-align:center">{{$gastoDetail->quantity}}</td>
                      <td style="text-align:center">$  {{number_format($gastoDetail->quantity*$gastoDetail->price,2)}}</td>
                     </td>
                    </tr>
                @endforeach
			</tbody>
			
		
			<tfoot id="detalle_totales">
				
				<tr>
					<td colspan="3" width="10" class="textright" style="padding-bottom: 10px;"><strong><span>TOTAL GASTOS</strong></span></td>
					<td class="textright" style="padding-bottom: 9px;"><strong><span>$ {{number_format($sale->total_expense,2)}} </strong></span></td>
			
				</tr>
		
		</tfoot>
	</table>



	
	<p><strong>Detalle Servicios Taller</strong></p>
	<br>
	<!-- Tabla Servicios Taller -->
	<table id="factura_detalle" class="table-striped">
			<thead>
				<tr>
					<th width="20px" style="text-align:center">Vehiculo</th>
					<th width="20px">Servicio</th>
					<th class="center" width="170px">Categoria Servicio</th>
					<th class="center" width="140px">Total Servicio ($)</th>	
				</tr>
			</thead>

			 @foreach($serviceDetails as $serviceDetail)
                 <tr>
				 	<td style="text-align:center">{{$serviceDetail->car->license_plate}}</td>
                      <td style="text-align:center">{{$serviceDetail->workshop->name_service}}</td>
                      <td style="text-align:center">{{$serviceDetail->workshop->categorywork->name}}</td>
                      <td style="text-align:center">${{$serviceDetail->total_service}}</td>
                     </td>
                    </tr>
                @endforeach
			</tbody>
			
		
			<tfoot id="detalle_totales">
				
				<tr>
					<td colspan="3" width="10" class="textright" style="padding-bottom: 10px;"><strong><span>TOTAL SERVICIOS TALLER</strong></span></td>
					<td class="textright" style="padding-bottom: 9px;"><strong><span>$ {{number_format($subtotalserv,2)}} </strong></span></td>
			
				</tr>
				<tr>
					<td colspan="3" class="textright" style="padding-bottom: 10px;"><strong><span>TOTAL FACTURA</span></strong></td>
					<td class="textright" style="padding-bottom: 9px;"><strong><span>${{number_format($sale->total + $sale->total_service_dealer + $sale->total_expense,2)}} </span></strong></td>
				</tr>
		</tfoot>
	</table>


	<div>
		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
		<h4 class="label_gracias">¡Gracias por su preferencia!</h4>

		@if($sale->status == "CANCELED")

		<div class="label_gracias">
		<img src="{{ public_path().'/image/boleta/'.$imagen_anulado }}" width="300" height="300" />
		</div>
		@else

		@endif

	</div>

</div>



</body>
</html>



