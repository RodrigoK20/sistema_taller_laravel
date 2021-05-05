@extends('layouts.admin')
@section('title','Detalles de Venta')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Detalles de venta
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles de venta</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4 text-center">
                            <label class="form-control-label"><strong>Cliente</strong></label>
                            <p><a href="{{route('clients.show', $sale->client)}}">{{$sale->client->name}}</a></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label"><strong>Vendedor</strong></label>
                            <p>{{$sale->user->name}}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label"><strong>Número Venta</strong></label>
                            <p>{{$sale->id}}</p>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <h4 class="card-title">Detalles de venta</h4>
                        <div class="table-responsive col-md-12">
                            <table id="saleDetails" class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio Venta ($)</th>
                                        <th>Descuento(%)</th>
                                        <th>Cantidad</th>
                                        <th>SubTotal($)</th>
                                    </tr>
                                </thead>
                                <tfoot>

                                    <tr>
                                        <th colspan="4">
                                            <p align="right">SUBTOTAL:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($subtotal,2)}}</p>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="4">
                                            <p align="right">TOTAL IMPUESTO ({{$sale->tax}}%):</p>
                                        </th>
                                        <th>
                                            <p align="right">s/{{number_format($subtotal*$sale->tax/100,2)}}</p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">
                                            <p align="right">TOTAL:</p>
                                        </th>
                                        <th>
                                            <p align="right" value="100" id="total_venta">${{number_format($sale->total,2)}}</p>
                                        </th>
                                    </tr> 

                                </tfoot>
                                <tbody>
                                    @foreach($saleDetails as $saleDetail)
                                    <tr>
                                        <td>{{$saleDetail->product->name}}</td>
                                        <td>${{$saleDetail->price}}</td>
                                        <td>{{$saleDetail->discount}} %</td>
                                        <td>{{$saleDetail->quantity}}</td>
                                        <td>s/{{number_format($saleDetail->quantity*$saleDetail->price - $saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100,2)}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>

                <!-- Detalle gastos -->
                    <div class="form-group">
                        <h4 class="card-title">Detalles de Gastos Repuestos/Productos</h4>
                        <div class="table-responsive col-md-12">
                            <table id="saleDetails" class="table">
                                <thead>
                                    <tr>
                                        <th>Repuesto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th style="width:10%;">SubTotal($)</th>
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr>
                                        <th colspan="3">
                                            <p align="right">TOTAL COMPRA REPUESTOS:</p>
                                        </th>
                                        <th>
                                            <p align="right" value="" id="total_venta">${{number_format($sale->total_expense,2)}}</p>
                                        </th>
                                    </tr> 

                                </tfoot>
                                <tbody>
                                    @foreach($gastosDetails as $gastosDetail)
                                    <tr>
                                        <td>{{$gastosDetail->name_product}}</td>
                                        <td>${{$gastosDetail->price}}</td>
                                        <td>{{$gastosDetail->quantity}}</td>
                                        <td>$ {{number_format($gastosDetail->quantity*$gastosDetail->price,2)}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


            <!-- Detalle servicio taller -->

                    <div class="form-group">
                        <h4 class="card-title">Detalles de servicio taller</h4>
                        <div class="table-responsive col-md-12">
                            <table id="saleDetails" class="table">
                                <thead>
                                    <tr>
                                        <th>Servicio Taller</th>
                                        <th>Categoria Servicio</th>
                                        <th>Mano de Obra ($)</th>
                                        <th style="width:10%;">Vehiculo</th>
                                    </tr>
                                </thead>
                                <tfoot>

                                    <tr>
                                        <th colspan="7">
                                            <p align="right">TOTAL SERVICIOS TALLER:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($subtotalserv,2)}}</p>
                                        </th>
                                    </tr>

                             
                                   <tr>
                                        <th colspan="7">
                                            <p align="right" style="color:red">TOTAL FACTURA:</p>
                                        </th>
                                        <th>
                                            <p align="right" style="color:red">${{number_format($sale->total + $sale->total_service_dealer,2)}} </p>
                                        </th>
                                    </tr> 

                                </tfoot>
                                <tbody>
                                    @foreach($serviceDetails as $serviceDetail)
                                    <tr>
                                        <td>{{$serviceDetail->workshop->name_service}}</td>
                                        <td>{{$serviceDetail->workshop->categorywork->name}}</td>
                                        <td>${{$serviceDetail->total_service}}</td>
                                        <td>{{$serviceDetail->car->license_plate}}</td>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('sales.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('scripts')
<script>

$( document ).ready(function() {



});
</script>

@endsection