@extends('layouts.admin')

<style type="text/css">
  .icon_eye{
    padding-top: 7px;
  }

  .icon_pdf{
    padding-top: 7px;
  }
</style>

@section('title','Gestión de compras')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Compras
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Compras</li>
            </ol>
        </nav>

        
    </div>
    <a href="{{route('purchases.create')}}">
    <span class="btn btn-primary md-5" style=" margin-bottom:15px;">+ Registrar Compra</span>
    </a>
    <br>
    <div class="row">



        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Compras</h4>
                      

                      <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                           <!--  <div class="dropdown-menu dropdown-menu-right">
                             
                               <a  class="dropdown-item" >Agregar</a>
                             
                            </div> -->
                          </div>
                    
                      </div>


{!! Form::open(['route'=>'report.purchases', 'method'=>'POST']) !!}

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
           <button type="submit"  class="btn btn-info btn-sm"> <i class="fas fa-file-pdf"></i> Generar Reporte</button>
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
                                    <th># Factura</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th style="width:15%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{$purchase->id}}</td>

                                    <td>{{$purchase->purchase_date}}</td>

                                    <td>{{$purchase->num_factura}}</td>

                                    <td>${{$purchase->total}}</td>

                                     @if($purchase->status == 'VALID')

                                    <td>
                                    
                                    <a class="btn btn-success" style="" href="{{route('change.status.purchases', $purchase)}}" title="Cambiar Estado">
                                            VALID <i class="fas fa-check"></i>
                                        </a>

                                    </td>

                                    @else

                                    <td>
                                        <a class="btn btn-danger" href="" title="Cambiar Estado">
                                            CANCELED <i class="fas fa-times"></i>
                                        </a>
                                    </td>

                                    @endif

                                    <td style="width: 50px;">
                                        {!! Form::open(['route'=>['purchases.destroy',$purchase], 'method'=>'DELETE']) !!}

                                        @csrf

                                        <a class="btn btn-dark " style="height:35px;width:50px" href="{{route('purchases.edit',$purchase)}}" type="submit" title="Ingresar comprobante" id="pic">
                                            <i class="fas fa-camera icon_pdf"></i>
                                        </a>

                                        <a class="btn btn-info " style="height:35px;width:50px" href="{{route('purchases.pdf',$purchase)}}" type="submit" title="PDF">
                                            <i class="fas fa-file-pdf icon_pdf"></i>
                                        </a>

                                        <a class="btn btn-warning" href="{{route('purchases.show',$purchase)}}" style="height:35px;width:50px" type="submit" title="Ver detalle">
                                            <i class="fas fa-eye icon_eye"></i>
                                        </a>
                                        
                               <!--          <button class="btn btn-danger eliminar " style="height:35px;width:50px" href="{{route('purchases.destroy', $purchase->id)}}" type="submit" title="Eliminar">
                                            <i class="far fa-trash-alt"></i>
                                        </button> -->

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                                

                            </tbody>
                        </table>
                    </div>
                </div>
                 <div class="card-footer text-muted">

                 <input type="hidden" id="error_picture" value="{{session('status')}}">

             @if (session('status'))
                 <div class="alert alert-warning">
                 Ya existe un comprobante de pago de la compra!
             </div>
            @endif

                </div>  
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
{!! Html::script('melody/js/data-table2.js') !!}
{!! Html::script('melody/js/sweetalert2.js') !!}
{!! Html::script('select/dist/js/bootstrap-select.min.js') !!}



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

@endsection