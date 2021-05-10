@extends('layouts.admin')
@section('title','Informacion de producto')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            {{$product->name}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">

                                <img src="{{asset('image/products/'.$product->image)}}" alt="Product Image" class="img-lg  mb-3" />
                             
                                <h3>{{$product->name}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                           
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Status
                                    </span>
                                    <span class="float-right text-muted">
                                        {{$product->status}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Proveedor
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="{{route('providers.show',$product->provider->id)}}">
                                        {{$product->provider->name}}
                                        </a>
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Categoría
                                    </span>
                                    <span class="float-right text-muted">
                                        {{--  PRODUCTOS POR CATEGORIA  --}}
                                        <a href="">
                                            {{$product->category->name}}
                                        </a>
                                    </span>
                                </p>
                              
                            </div>

                            {{--  <button class="btn btn-primary btn-block">{{$product->status}}</button>  --}}
                            @if ($product->status == 'ACTIVE')
                            <a href="" class="btn btn-success btn-block">Activo</a>
                            @else
                            <a href="" class="btn btn-danger btn-block">Desactivado</a>
                            @endif
                        </div>
                        <div class="col-lg-8 pl-lg-5">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Información de producto</h4>
                                </div>
                            </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">

                                    <div class="form-group col-md-6">
                                        <strong><i class="fas fa-list-ol mr-1"></i> Código</strong>
                                        <p class="text-muted">
                                            {{$product->code}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-cubes mr-1"></i> Stock</strong>
                                        <p class="text-muted">
                                            {{$product->stock}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-box mr-1"></i> Unidad Medida</strong>
                                        <p class="text-muted">
                                            {{$product->unit->name}}
                                        </p>
                                        <hr>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <strong>
                                            <i class="fas fa-envelope  mr-1"></i>
                                            Codigo de barras</strong>

                                            <p class="text-muted">
                                            {!!DNS1D::getBarcodeHTML($product->code, 'C128'); !!}
                                        </p>
                                      
                             
                                        <hr>

                                        <strong>
                                            <i class="fas fa-dollar-sign mr-1"></i>
                                            Precio de venta</strong>
                                        <p class="text-muted">
                                            {{$product->sell_price}}
                                        </p>

                                        <hr>

                                        <strong>
                                        @foreach ($query as $price)
                                            <i class="fas fa-dollar-sign mr-1"></i>
                                            Precio de compra</strong>

                                            
                                        <p class="text-muted">
                                            {{$price->costo}}
                                        </p>
                                     @endforeach

                                        <hr>
                                        
                                        {{--  <strong><i class="fas fa-map-marked-alt mr-1"></i> Categoría</strong>
                                        <p class="text-muted">
                                            {{$product->category->name}}
                                        </p>
                                        <hr>  --}}
                                        {{--  <strong><i class="fas fa-map-marked-alt mr-1"></i> Proveedor</strong>
                                        <p class="text-muted">
                                            {{$product->provider->name}}
                                        </p>
                                        <hr>  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('products.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection



