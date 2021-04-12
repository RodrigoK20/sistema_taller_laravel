@extends('layouts.admin')
@section('title','Registro de Servicio ')


@section('create')

@endsection

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Venta
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('sales.index')}}">Listado Ventas</a></li>
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
                        <h4 class="card-title">Registro de Servicio Taller</h4>

                        
                </div>
                {!! Form::model($sale ,['route'=>['sales.update',$sale],'method'=>'PUT']) !!}
                @include('admin.sale._form2')

              

                </div>
        

              <div class="card-footer text-muted">
            <button type="submit" id="guardar2" class="btn btn-primary mr-2">Guardar</button>
                
                <a href="{{route('sales.index')}}" class="btn btn-light">Cancelar</a>
            </div>
            
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>





@endsection





