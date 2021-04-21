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



@section('title','Reporte por Fecha')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Reporte por rango de fecha
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reporte por rango de fecha</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        {{--  <h4 class="card-title">Reporte por rango de fecha </h4>  --}}
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

                    {!! Form::open(['route'=>'report.results', 'method'=>'POST']) !!}

                    <div class="row ">
            
                        <div class="col-12 col-md-2">
                            <span>Fecha inicial</span>
                            <div class="form-group">
                                <input class="form-control" type="date" 
                                value="{{old('fecha_ini')}}" 
                                name="fecha_ini" id="fecha_ini" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <span>Fecha final</span>
                            <div class="form-group">
                                <input class="form-control" type="date" 
                                value="{{old('fecha_fin')}}" 
                                name="fecha_fin" id="fecha_fin" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 text-center mt-4">
                            <div class="form-group">
                               <button type="submit" id="btn_consultar" name="btn_consultar" value="1" class="btn btn-primary btn-sm">Consultar</button>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 text-center mt-4">
                            <div class="form-group">
                               <button type="submit"  class="btn btn-info btn-sm"> <i class="fas fa-file-pdf"></i> Reporte Historico</button>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-2 text-center">
                            <span>Total de ingresos productos: <b> </b></span>
                            <div class="form-group">
                                <strong>$ {{$total}}</strong>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 text-center">
                            <span>Total servicios taller generado: <b> </b></span>
                            <div class="form-group">
                                <strong>$ {{$totaltaller}}</strong>
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}
                    
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Taller</th>
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
                                        {{\Carbon\Carbon::parse($sale->sale_date)->format('d M Y ')}}
                                    </td>
                                    <td>{{$sale->total}}</td>
                                    <td>{{$sale->total_service_dealer}}</td>
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

<script>
    window.onload = function(){
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
          dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
          mes='0'+mes //agrega cero si el menor de 10
        document.getElementById('fecha_fin').value=ano+"-"+mes+"-"+dia;
      }
</script>

@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
@endsection


