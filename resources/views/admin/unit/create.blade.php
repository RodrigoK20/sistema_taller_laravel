@extends('layouts.admin')
@section('title','Registro de Unidad')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Unidades Medidas
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('units.index')}}">Listado Unidades</a></li>
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
                        <h4 class="card-title">Registro de Unidades</h4>

                        
                </div>
                {!! Form::open(['route'=>'units.store','method'=>'POST']) !!}
                @include('admin.unit._form')

                <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                
                <a href="{{route('units.index')}}" class="btn btn-light">Cancelar</a>

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection




