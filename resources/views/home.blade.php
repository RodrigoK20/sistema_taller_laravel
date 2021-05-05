@extends('layouts.admin')


@section('title','Dashboard')


@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
           Panel Administrador
        </h3>
        
    </div>
   
    <br>
   
    @foreach ($totales as $total)
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card text-white bg-warning">

                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fas fa-cart-arrow-down fa-4x"></i>
                    </div>
                    <div class="text-value h4"><strong>$ {{$total->totalcompra}} (MES ACTUAL)</strong>
                    </div>
                    <div class="h3">Compras</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                    <a href="{{route('purchases.index')}}" class="small-box-footer h4">Compras <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card  text-white bg-info">

                <div class="card-body pb-0">

                    <div class="float-right">
                        <i class="fas fa-shopping-cart fa-4x"></i>
                    </div>
                    <div class="text-value h4"><strong>$ {{$total->totalgananciaprod}} (MES ACTUAL) </strong>
                    </div>
                    <div class="h3">Total Ganancias Productos</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                    <a href="{{route('sales.index')}}" class="small-box-footer h4">Ventas <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
    </div>
    @endforeach




    <!-- Dash vehiculos -->
    @foreach ($totalrepuestosxdia as $totalrepuesto)
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card text-white bg-primary">

                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fas fa-oil-can fa-4x"></i>
                    </div>
                    <div class="text-value h4"><strong>${{$totalrepuesto->totalr}}</strong>
                    </div>
                    <div class="h3">Total Compra Repuestos (Día Actual)</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                    <a href="{{route('sales.index')}}" class="small-box-footer h4">Ventas <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
        @endforeach

        @foreach ($cantidadautos as $autos)
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card  text-white bg-primary">

                <div class="card-body pb-0">

                    <div class="float-right">
                        <i class="fas fa-car fa-4x"></i>
                    </div>
                    <div class="text-value h4"><strong>{{$autos->numautos}}</strong>
                    </div>
                    <div class="h3"># Vehículos Registrados</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                    <a href="{{route('sales.index')}}" class="small-box-footer h4">Ventas <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
        @endforeach
    </div>


        <!-- Dash gastos -->
        @foreach ($tallertotales as $total)
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card text-white bg-dark">

                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fas fa-money-bill-wave fa-4x"></i>
                    </div>
                    <div class="text-value h4"><strong>${{$total->gastos_taller}}</strong>
                    </div>
                    <div class="h3">Gastos Diario Taller</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                    <a href="{{route('expenseshop.index')}}" class="small-box-footer h4">Gastos <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
 

     
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card  text-white bg-dark">

                <div class="card-body pb-0">

                    <div class="float-right">
                        <i class="fas fa-wrench fa-4x"></i>
                    </div>
                    <div class="text-value h4"><strong>${{$total->totalservicios}}</strong>
                    </div>
                    <div class="h3">Total Servicios Taller (Día Actual)</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:35px;">
                    <a href="{{route('cars.index')}}" class="small-box-footer h4">Vehículos <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
        @endforeach
    </div>




        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Dashboard</h4></div>

  

<!-- VENTAS DIARIAS -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fas fa-gift"></i>
                    Ventas diarias
                </h4>
                <canvas id="ventas_diarias" height="70"></canvas>
                <div id="orders-chart-legend" class="orders-chart-legend"></div>
            </div>
        </div>
    </div>




        
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-gift"></i>
                        Compras - Meses
                    </h4>
                    <canvas id="compras"></canvas>
                    <div id="orders-chart-legend" class="orders-chart-legend"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Ventas - Meses
                    </h4>
                    <canvas id="ventas"></canvas>
                </div>
            </div>
        </div>
    </div>


    
   
    <!-- TABLA PRODUCTOS MAS VENDIDOS -->
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-pallet"></i>
                        Productos más vendidos
                    </h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Stock</th>
                                    <th>Cantidad vendida</th>
                                    <th>Ver detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productosvendidos as $productosvendido)
                                <tr>
                                    <td>{{$productosvendido->id}}</td>
                                    <td>{{$productosvendido->name}}</td>
                                    <td>{{$productosvendido->code}}</td>
                                    <td><strong>{{$productosvendido->stock}}</strong> Unidades</td>
                                    <td><strong>{{$productosvendido->quantity}}</strong> Unidades</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{route('products.show', $productosvendido->id)}}">
                                            <i class="far fa-eye"></i>
                                            Ver detalles
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

       
    <!-- TABLA PRODUCTOS STOCK -->
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Alerta Productos Stock Inventario
                    </h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Stock</th>
                                    <th>Ver detalles</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($productosstock as $producto)
                                    @if($producto->stock == 0)

                                <tr style="background-color: #FF0000;">

                                <td>{{$producto->id}}</td>
                                    <td>{{$producto->name}}</td>
                                    <td>{{$producto->code}}</td>
                                    <td><strong>{{$producto->stock}}</strong> Unidades</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{route('products.show', $producto->id)}}">
                                            <i class="far fa-eye"></i>
                                            Ver detalles
                                        </a>
                                    </td>
                                
                                </tr>

                                @elseif($producto->stock <= 5)


                                <tr style="background-color: #4C8BF5;">

                                <td>{{$producto->id}}</td>
                                    <td>{{$producto->name}}</td>
                                    <td>{{$producto->code}}</td>
                                    <td><strong>{{$producto->stock}}</strong> Unidades</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{route('products.show', $producto->id)}}">
                                            <i class="far fa-eye"></i>
                                            Ver detalles
                                        </a>
                                    </td>
                                
                                </tr>

                             

                                @endif
                             
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>










                      
        </div>
    </div>




</div>


@endsection

@section('scripts')

{!! Html::script('melody/js/chart.js') !!}
<script>
    $(function () {
        var varCompra=document.getElementById('compras').getContext('2d');
    
            var charCompra = new Chart(varCompra, {
                type: 'line',
                data: {
                    labels: [<?php foreach ($comprasmes as $reg)
                        { 
                    
                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                    $mes_traducido=strftime('%B',strtotime($reg->mes));
            
                    echo '"'. $mes_traducido.'",';} ?>],
                    datasets: [{
                        label: 'Compras',
                        data: [<?php foreach ($comprasmes as $reg)
                            {echo ''. $reg->totalmes.',';} ?>],
                    
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth:3
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            var varVenta=document.getElementById('ventas').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'line',
                data: {
                    labels: [<?php foreach ($ventasmes as $reg)
                {
                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                    $mes_traducido=strftime('%B',strtotime($reg->mes));
                    
                    echo '"'. $mes_traducido.'",';} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventasmes as $reg)
                        {echo ''. $reg->totalmes.',';} ?>],
                        backgroundColor: 'rgba(20, 204, 20, 1)',
                        borderColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });


            var varVenta=document.getElementById('ventas_diarias').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($ventasdia as $ventadia)
                {
                    $dia = $ventadia->dia;
                    
                    echo '"'. $dia.'",';} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventasdia as $reg)
                        {echo ''. $reg->totaldia.',';} ?>],
                        backgroundColor: 'rgba(20, 204, 20, 1)',
                        borderColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });





    });

</script>

@endsection


