@extends('layouts.admin')
@section('title','Registro de Compra')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Compra
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('purchases.index')}}">Listado compras</a></li>
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
                        <h4 class="card-title">Registro de compra</h4>

                        
                </div>
                {!! Form::open(['route'=>'purchases.store','method'=>'POST']) !!}
                @include('admin.purchase._form')

              

                </div>
        

              <div class="card-footer text-muted">
            <button type="submit" id="guardar" class="btn btn-primary mr-2">Guardar</button>
                
                <a href="{{route('purchases.index')}}" class="btn btn-light">Cancelar</a>
            </div>
            
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection




