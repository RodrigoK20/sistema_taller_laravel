@extends('layouts.admin')
@section('title','Editar rol')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Rol
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Listado roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        
    </div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Editar rol</h4>
                </div>
                {!! Form::model($role ,['route'=>['roles.update',$role],'method'=>'PUT']) !!}
  
                <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text"
                          class="form-control" name="name" id="name" value="{{$role->name}}" aria-describedby="helpId" placeholder="">
                      </div>
                      <div class="form-group">
                          <label for="slug">Slug</label>
                          <input type="text"
                            class="form-control" name="slug" id="slug" value="{{$role->slug}}" aria-describedby="helpId" placeholder="">
                        </div>
                      <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{$role->description}}</textarea>
                      </div>

                      @include('admin.role._form')

                <button type="submit" class="btn btn-warning mr-2">Actualizar</button>
                
                <a href="{{route('roles.index')}}" class="btn btn-light">Cancelar</a>

                

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection




