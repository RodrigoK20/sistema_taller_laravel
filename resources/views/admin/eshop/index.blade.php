@extends('layouts.admin')

<style type="text/css">
  .icon_edit{
    padding-top: 8px;
  }
</style>

@section('title','Gestión de Gastos Taller')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Gastos Taller
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gastos Taller</li>
            </ol>
        </nav>

        
    </div>
    
    <br>
    <div class="row">



    <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Gastos</h4>
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#index" role="tab" aria-controls="index" aria-selected="true"><i class="fas fa-bars"></i> Listado de Gastos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#add" role="tab" aria-controls="profile-1" aria-selected="false"><i class="fas fa-plus-circle"></i> Agregar Gasto</a>
                    </li>
                  <!--   <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#report" role="tab" aria-controls="contact-1" aria-selected="false"><i class="fas fa-chart-line"></i> Informes</a>
                    </li> -->
                  </ul>

                  <!-- Index !-->
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="index" role="tabpanel" aria-labelledby="home-tab">
                      <div class="media">
                       
                        <div class="media-body">
                 
                        <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Etiqueta de gasto</th>
                                    <th>Monto del gasto</th>
                                    <th>Estado</th>
                                    <th>Fecha Registro</th>
                                    <th>Fecha Pagado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
    
                            @foreach ($expenseshop as $gasto)
                                <tr>
                                    <th scope="row">{{$gasto->id}}</th>
                                    <td>
                                       {{$gasto->tag}}
                                    </td>
                                    <td>${{$gasto->mount}}</td>

                                                
                                    @if($gasto->status == 'UNPAID')

                                    <td>
                                    
                                    <a class="btn btn-warning" style="height:35px;width:90px" href="" title="PAGAR">
                                             <i class="fas fa-exclamation-triangle btn-icon-append icon_edit"></i>
                                        </a>

                                    </td>

                                    @else
                                    <td>
                                        <a class="btn btn-success" href="" title="" style="height:35px;width:90px" >
                                        <i class="fas fa-check-circle btn-icon-append icon_edit"></i>
                                        </a>
                                    </td>

                                    @endif

                                    <td>{{$gasto->date_registry}}</td>
                                    <td>{{$gasto->date_paid}}</td>

                                    <td style="width: 50px;">
                                        {!! Form::open(['route'=>['expenseshop.destroy',$gasto], 'method'=>'DELETE']) !!}

                                        @csrf


                                        <a class="btn btn-primary" type="submit" href="{{route('expenseshop.edit', $gasto->id)}}"   style="height:35px;width:50px" title="Pagar">
                                            <i class="fas fa-money-bill-alt btn-icon-append icon_edit"></i>
                                        </a>
                                        
                                        <button class="btn btn-danger eliminar " style="height:35px;width:50px" href="{{route('expenseshop.destroy', $gasto->id)}}" type="submit" title="Eliminar">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>


                      
                 
                 
                 @if (session('status'))
                     <div class="alert alert-warning">
                     Ya se encuentra registrado el pago del gasto!
                 </div>
                @endif
    
    
    
                  

                    </div>


                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="media">
                      
                        <div class="media-body">
                          <h4 class="mt-0">Agregar Gasto</h4>
                     
                <div class="form-group">
                {!! Form::open(['route'=>'expenseshop.store','method'=>'POST']) !!}

                    <div class="form-group">
                      <label for="name">Etiqueta de Gasto</label>
                      <input type="text" class="form-control" name="tag" id="tag" placeholder="" required>
                    </div>

                    @if ($errors->has('tag'))
                    <span class="text-danger">{{ $errors->first('tag') }}</span>
                     @endif
                    <br>
                    <div class="form-group">
                      <label for="description">Monto del gasto ($)</label>
                      <input type="number" step="0.01" class="form-control" name="mount" id="mount" placeholder="" required >
                    </div>
                  <br>
                    @if ($errors->has('mount'))
                    <span class="text-danger">{{ $errors->first('mount') }}</span>
                     @endif

                     <div class="form-group">
                      <label for="description">Fecha Registro</label>
                      <input type="date" class="form-control" name="date_registry" id="date_registry" placeholder="" required >
                    </div>
                  <br>
                    @if ($errors->has('date_registry'))
                    <span class="text-danger">{{ $errors->first('date_registry') }}</span>
                     @endif


                     <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                
                

                    </div>

                    {!! Form::close() !!}



                        </div>
                      </div>
                    </div>

            




    </div>
</div>

<!-- Modal PAGAR GASTO !-->

<div class="modal fade" id="paid" tabindex="-1" role="dialog" aria-labelledby="cambio"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambio">Pagar Gasto </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

            <div class="form-group">
                    <label for="name">Monto: </label>
                    <input type="text" class="form-control" name="monto" id="monto"  aria-describedby="helpId" readonly>


            </div>


                <div class="form-group">
                    <label for="name">Fecha pagada del gasto:</label>
                    <input type="date" class="form-control" name="date_paid" id="date_paid" placeholder="" required >


            </div>
            <div class="modal-footer">
                <a type="button"  class="btn btn-success" href="{{route('expenseshop.edit',4)}}" type="submit">Pagar</a>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
            </div>


</div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}

<script>

$(document).ready(function() {
    $('table1.display').DataTable();
} );


    $(document).on("click", ".openmodal", function () {
                                //data-id
     var monto = $(this).data('id');
     $(".modal-body #monto").val('$'+monto );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>

@endsection


