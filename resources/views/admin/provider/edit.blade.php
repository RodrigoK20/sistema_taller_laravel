@extends('layouts.admin')
@section('title','Editar proveedor')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Proveedres
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('providers.index')}}">Listado proveedores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        
    </div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Editar proveedor</h4>
                </div>
                {!! Form::model($provider ,['route'=>['providers.update',$provider],'method'=>'PUT']) !!}
  
                <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{$provider->name}}">
                    </div>

                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
                    <br>

                    
                    <div class="form-group">
                    <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{$provider->email}}">
                    </div>

                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                     @endif
                    
                    
                    <div class="form-group">
                    <label for="ruc">Numero de RUC</label>
                      <input type="text" class="form-control" name="ruc_number" id="ruc_number" placeholder="RUC Numero" value="{{$provider->ruc_number}}">
                    </div>

                    @if ($errors->has('ruc_number'))
                    <span class="text-danger">{{ $errors->first('ruc_number') }}</span>
                     @endif

                    
                    <div class="form-group">
                    <label for="direcion">Dirección</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Dirección" value="{{$provider->address}}">
                    </div>

                    @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                     @endif

                    
                    
                    <div class="form-group">
                      <label for="description">Teléfono</label>
                      <input type="text" class="form-control" name="phone" id="phone" placeholder="Teléfono" value="{{$provider->phone}}">
                    </div>
                 

                    @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                     @endif




                <button type="submit" class="btn btn-warning mr-2">Actualizar</button>
                
                <a href="{{route('providers.index')}}" class="btn btn-light">Cancelar</a>

                

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection




