@extends('layouts.admin')
@section('title','Registro de Rol')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Roles
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Listado roles</a></li>
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
                        <h4 class="card-title">Registro de Rol</h4>


                    </div>
                    {!! Form::open(['route'=>'roles.store','method'=>'POST']) !!}
                   

                    <div class="form-group">
                        <label for="password">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>


                    <div class="form-group">
                        <label for="password">Slugs (URL)</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="password">Descripción</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>

                    @include('admin.role._form')

             
                    <button type="submit" class="btn btn-primary mr-2">Guardar</button>

                    <a href="{{route('roles.index')}}" class="btn btn-light">Cancelar</a>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
