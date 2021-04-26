@extends('layouts.admin')
@section('title','Registro de Cotización')


@section('create')
<li class="nav-item d-none d-lg-flex">
    <a class="nav-link" type="button" data-toggle="modal" data-target="#exampleModal-2">
      <span class="btn btn-warning">+ Registrar cliente</span>
    </a>
</li>

<a class="nav-link" type="button" data-toggle="modal" data-target="#exampleModal-3">
      <span class="btn btn-info ml-10">+ Registrar Vehículo</span>
    </a>


@endsection

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Cotización
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('cotizacions.index')}}">Cotizaciones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            </ol>
        </nav>

        
    </div>

<div>

</div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Registro de Cotización</h4>

                        
                </div>
                {!! Form::open(['route'=>'cotizacions.store','method'=>'POST']) !!}
                @include('admin.cotizacion._form')
              
                </div>
        

              <div class="card-footer text-muted">
            <button type="submit" id="guardar" class="btn btn-primary mr-2">Guardar</button>
                
                <a href="{{route('cotizacions.index')}}" class="btn btn-light">Cancelar</a>
            </div>
            
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>



<!-- MODAL CLIENTE -->
<div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Registro rápido de cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {!! Form::open(['route'=>'clients.store', 'method'=>'POST','files' => true]) !!}


            <div class="modal-body">

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" required>
                    @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                 @endif
                </div>
                <div class="form-group">
                    <label for="dui">DUI</label>
                    <input type="number" class="form-control" name="dui" id="dui" aria-describedby="helpId" required>
                    @if ($errors->has('dui'))
                    <small class="text-danger">{{ $errors->first('dui') }}</small>
                    @endif
                </div>

                
        <div class="form-group">
            <label for="phone">Teléfono \ Celular</label>
            <input type="number" class="form-control" name="phone" id="phone" aria-describedby="helpId">
            @if ($errors->has('phone'))
                    <small class="text-danger">{{ $errors->first('phone') }}</small>
             @endif
        </div>
    

                <input type="hidden" name="sale" value="1">

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>

        {!! Form::close() !!}

        </div>
    </div>
</div>


<!-- Modal Vehiculo -->

<div class="modal fade" id="exampleModal-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-3"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Registro rápido de Vehiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            {!! Form::open(['route'=>'cars.store', 'method'=>'POST','files' => true]) !!}


            <div class="modal-body">

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="brand" id="" placeholder="Marca" required>
                    @if ($errors->has('brand'))
                    <small class="text-danger">{{ $errors->first('brand') }}</small>
                 @endif
                </div>
                <div class="form-group">
                    <label for="model">Modelo</label>
                    <input type="text" class="form-control" name="model" id="model" placeholder="Modelo" required>
                    @if ($errors->has('model'))
                    <small class="text-danger">{{ $errors->first('model') }}</small>
                    @endif
                </div>

                
        <div class="form-group">
            <label for="license_plate">Placa</label>
            <input type="text" class="form-control" name="license_plate" id="" placeholder="Placa" max="8" required>
            @if ($errors->has('license_plate'))
                    <small class="text-danger">{{ $errors->first('license_plate') }}</small>
             @endif
        </div>

                      
        <div class="form-group">
            <label for="year">Año</label>
            <input type="text" class="form-control" name="year" id=""  placeholder="Año" maxlength="7" minlength="4"  required>
            @if ($errors->has('year'))
                    <small class="text-danger">{{ $errors->first('year') }}</small>
             @endif
        </div>

        <div class="form-group">
            <label for="year">Viscosidad</label>
            <input type="text" class="form-control" name="viscosity" id="" placeholder="Viscosidad">
            <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
            @if ($errors->has('viscosity'))
                    <small class="text-danger">{{ $errors->first('viscosity') }}</small>
             @endif
        </div>

        
                      
        <div class="form-group">
            <label for="year">Cliente</label>
            <select class="form-control" name="client_id" id="client_id">
                        @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                      </select>
            @if ($errors->has('year'))
                    <small class="text-danger">{{ $errors->first('year') }}</small>
             @endif
        </div>

    
         <input type="hidden" name="sale" value="1">

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>

        {!! Form::close() !!}

        </div>
    </div>
</div>



<!-- Modal Cambio !-->

<div class="modal fade" id="cambio" tabindex="-1" role="dialog" aria-labelledby="cambio"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambio">Consultar cambio </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <div class="form-group">
                    <label for="name">Cliente entrega $:</label>
                    <input type="text" class="form-control" name="cash_client" id="cash_client" aria-describedby="helpId" required>



            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-success" id="consultarcash">consultar</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>



        </div>
    </div>
</div>
</div>


@endsection





