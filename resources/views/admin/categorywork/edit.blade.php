@extends('layouts.admin')
@section('title','Editar servicio taller')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Categorias
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Listado categorias</a></li>
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
                {!! Form::model($categorywork ,['route'=>['categorieswork.update',$categorywork],'method'=>'PUT']) !!}
  
                <div class="form-group">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{$categorywork->name}}">
                    </div>

                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif

     
                    <div class="form-group">
                    <div class="form-group">
                      <label for="name">Descripción</label>
                      <input type="text" class="form-control" name="description" id="description" placeholder="" value="{{$categorywork->description}}">
                    </div>

                    @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                     @endif


                <button type="submit" class="btn btn-warning mr-2">Actualizar</button>
                
                <a href="{{route('categorieswork.index')}}" class="btn btn-light">Cancelar</a>

                

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection




