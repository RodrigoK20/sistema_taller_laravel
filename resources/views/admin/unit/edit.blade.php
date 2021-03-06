@extends('layouts.admin')
@section('title','Editar unidad')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Unidades
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('units.index')}}">Listado unidades</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        
    </div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Editar categoría</h4>
                </div>
                {!! Form::model($unit ,['route'=>['units.update',$unit],'method'=>'PUT']) !!}
  
                <div class="form-group">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{$unit->name}}">
                    </div>

                    <div class="form-group">
                      <label for="description">Descripción</label>
                      <input type="text" class="form-control" name="description" id="description" placeholder="Descripción" value="{{$unit->description}}">
                    </div>
                </div>



                <button type="submit" class="btn btn-warning mr-2">Actualizar</button>
                
                <a href="{{route('units.index')}}" class="btn btn-light">Cancelar</a>

                

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection




