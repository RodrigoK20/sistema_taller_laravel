@extends('layouts.admin')

<style type="text/css">
    .unstyled-button {
        border: none;
        padding: 0;
        background: none;
      }

      .icon_eye{
    padding-top: 4px;

  }
</style>

@section('title','Reporte por dia')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Reporte de ventas
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reporte de ventas</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        {{--  <h4 class="card-title">Reporte de ventas </h4>  --}}
                        {{--  <i class="fas fa-ellipsis-v"></i>  --}}
                        {{--  <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a href="{{route('sales.create')}}" class="dropdown-item">Registrar</a>
                            </div>
                        </div>  --}}
                    </div>

                    <div class="row ">
                        <div class="col-12 col-md-2 text-center">
                            <span>Fecha de consulta: <b> </b></span>
                            <div class="form-group">
                                <strong>{{\Carbon\Carbon::now()->format('d/m/Y')}}</strong>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 text-center">
                            <span>Cantidad de registros: <b></b></span>
                            <div class="form-group">
                                <strong>{{$sales->count()}}</strong>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 text-center">
                            <span>Total de ingresos productos: <b> </b></span>
                            <div class="form-group">
                                <strong>s/ {{$total}}</strong>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 text-center">
                            <span>Total servicios taller generado: <b> </b></span>
                            <div class="form-group">
                                <strong>$ {{$totaltaller}}</strong>
                            </div>
                        </div>

                    </div>


                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th style="width:50px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                <tr>
                                    <th scope="row">
                                        <a href="{{route('sales.show', $sale)}}">{{$sale->id}}</a>
                                    </th>
                                    <td>
                                    <!-- h:i a !-->
                                        {{\Carbon\Carbon::parse($sale->sale_date)->format('d M Y ')}}
                                    </td>
                                    <td>{{$sale->total}}</td>
                                    <td>{{$sale->status}}</td>
                                    <td style="">
                                       
                                 

                                        <a href="{{route('sales.pdf', $sale)}}" class="btn btn-info" style="height:35px;width:50px"> <i class="fas fa-file-pdf icon_eye"></i></a>
                                        <a href="{{route('sales.show', $sale)}}" class="btn btn-warning" style="height:35px;width:50px"><i class="fas fa-eye icon_eye"></i></a>
                                   
                                      
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
</div>




@endsection

@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
@endsection


