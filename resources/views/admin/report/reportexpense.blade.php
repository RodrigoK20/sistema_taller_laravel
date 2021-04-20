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

                    {!! Form::open(['route'=>'report.result2', 'method'=>'POST']) !!}

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
<!-- 
                        <div class="col-12 col-md-2 text-center mt-4">
                            <div class="form-group">
                               <button type="submit"  class="btn btn-info btn-sm"> <i class="fas fa-file-pdf"></i> Reporte Historico</button>
                            </div>
                        </div> -->
                        
                        <div class="col-12 col-md-2 text-center">
                            <span>Total pagado en gastos <b> </b></span>
                            <div class="form-group">
                                <strong>${{$total}}</strong>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 text-center">
                            <span>Número de gastos: <b> </b></span>
                            <div class="form-group">
                             
                @foreach($cantidad as $cantidadgasto) 

                     <strong>{{$cantidadgasto->cantidad_gastos}}</strong>

                    @endforeach
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}
                    
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Etiqueta de gasto</th>
                                    <th>Monto del gasto</th>
                                    <th>Estado</th>
                                    <th>Fecha Registro</th>
                                    <th>Fecha Pagado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expense as $gasto)
                                <tr>
                                    <th scope="row">
                                   {{$gasto->id}}
                                    </th>
                                    <td>{{$gasto->tag}}</td>
                                    <td>${{$gasto->mount}}</td>
                                    <td>{{$gasto->status}}</td>
                                    <td>
                                        {{\Carbon\Carbon::parse($gasto->date_registry)->format('d M y h:i a')}}
                                    </td>

                                    <td>
                                        {{\Carbon\Carbon::parse($gasto->date_paid)->format('d M y h:i a')}}
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


