@extends('layouts.admin')
@section('title','Editar cliente')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Proveedres
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Listado clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        
    </div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Editar cliente</h4>
                </div>
                {!! Form::model($client ,['route'=>['clients.update',$client],'method'=>'PUT','files' => true]) !!}
  
                <div class="form-row">
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" required value="{{$client->name}}">
            @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
             @endif
        </div>
    </div>
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" value="{{$client->email}}">
            <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
            @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
             @endif
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="dui">DUI</label>
            <input type="number" class="form-control" name="dui" id="dui" aria-describedby="helpId" value="{{$client->dui}}">
            <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
            @if ($errors->has('dui'))
                    <small class="text-danger">{{ $errors->first('dui') }}</small>
             @endif
        </div>
    </div>
    

    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="phone">Teléfono \ Celular</label>
            <input type="number" class="form-control" name="phone" id="phone" aria-describedby="helpId" value="{{$client->phone}}"> 
            @if ($errors->has('phone'))
                    <small class="text-danger">{{ $errors->first('phone') }}</small>
             @endif
        </div>
    </div>
</div>
<div class="form-group">
    <label for="address">Dirección</label>
    <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId" value="{{$client->address}}">
    <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>

    @if ($errors->has('address'))
                    <small class="text-danger">{{ $errors->first('address') }}</small>
             @endif
</div>



                <button type="submit" class="btn btn-warning mr-2">Actualizar</button>
                
                <a href="{{route('clients.index')}}" class="btn btn-light">Cancelar</a>

                

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('melody/js/dropify.js') !!}
@endsection


