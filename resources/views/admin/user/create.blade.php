@extends('layouts.admin')
@section('title','Registro de Usuario')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Categorias
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Listado usuarios</a></li>
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
                        <h4 class="card-title">Registro de Usuario</h4>


                    </div>
                    {!! Form::open(['route'=>'users.store','method'=>'POST']) !!}

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>

                    @include('admin.user._form')

                    <button type="submit" class="btn btn-primary mr-2">Guardar</button>

                    <a href="{{route('users.index')}}" class="btn btn-light">Cancelar</a>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
