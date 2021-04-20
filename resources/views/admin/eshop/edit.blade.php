@extends('layouts.admin')
@section('title','Pagar Gasto Taller')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Categorias
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('expenseshop.index')}}">Gestion gastos taller</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pagar</li>
            </ol>
        </nav>

        
    </div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Pagar Gasto Taller</h4>
                </div>
                {!! Form::model($expenseshop ,['route'=>['expenseshop.update',$expenseshop],'method'=>'PUT']) !!}
  
                <div class="form-group">
                    <div class="form-group">
                      <label for="name">Monto</label>
                      <input type="text" class="form-control" name="monto" id="monto" placeholder="" value="{{$expenseshop->mount}}" readonly>
                    </div>

                    
                    <div class="form-group">
                    <label for="name">Fecha pagada del gasto:</label>
                    <input type="date" class="form-control" name="date_paid" id="date_paid" placeholder="" required >


            </div>
                   
                </div>



                <button type="submit" class="btn btn-warning mr-2">Pagar</button>
                
                <a href="{{route('expenseshop.index')}}" class="btn btn-light">Cancelar</a>

                

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection




