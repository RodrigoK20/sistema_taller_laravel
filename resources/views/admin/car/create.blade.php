@extends('layouts.admin')
@section('title','Registro de Vehiculo')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Vehiculos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('cars.index')}}">Listado vehiculos</a></li>
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
                        <h4 class="card-title">Registro de Vehiculos</h4>

                        
                </div>
                {!! Form::open(['route'=>'cars.store','method'=>'POST','files' => true]) !!}
                @include('admin.car._form')

                <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                
                <a href="{{route('cars.index')}}" class="btn btn-light">Cancelar</a>

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')

{!! Html::script('melody/js/dropify.js') !!}
{!! Html::script('melody/js/sweetalert2.js') !!}
@endsection