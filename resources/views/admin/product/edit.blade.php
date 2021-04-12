@extends('layouts.admin')
@section('title','Editar producto')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Producto
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Listado productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        
    </div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Editar producto</h4>
                </div>
                {!! Form::model($product ,['route'=>['products.update',$product],'method'=>'PUT','files' => true]) !!}
  
                <div class="form-row">
              <div class="form-group col-md-6">
                <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" id="name" class="form-control" aria-describedby="helpId" required value="{{$product->name}}">
                    </div>

                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
                </div>


            <div class="form-group col-md-6">

                     <div class="form-group">
                     <label for="code">Código de barras</label>
                     <input type="number" name="code" id="code" class="form-control"  aria-describedby="helpId" value="{{$product->code}}">
                     <small id="helpId" class="text-muted">Campo opcional</small>
                    </div>

                    @if ($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                     @endif
                </div>
            </div>

 <div class="form-row">
  <div class="form-group col-md-6">

                    <div class="form-group">
                        <label for="sell_price">Precio de venta ($)</label>
                        <input type="number" name="sell_price" id="sell_price" step="0.01" class="form-control" aria-describedby="helpId" required value="{{$product->sell_price}}">
                    </div>

                    @if ($errors->has('sell_price'))
                    <span class="text-danger">{{ $errors->first('sell_price') }}</span>
                     @endif

              </div>

  <div class="form-group col-md-6">


                    <div class="form-group">
                      <label for="category_id">Categoría</label>
                      <select class="form-control" name="category_id" id="category_id" >
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" 
                          @if($category->id == $product->category_id){
                            selected
                          }
                          @endif
                        
                        >{{$category->name}}
                        
                        </option>
                        @endforeach
                      </select>
                    </div>

                    @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                     @endif

              </div>
           </div>

<div class="form-row">
  <div class="form-group col-md-6">


                    <div class="form-group">
                        <label for="provider_id">Proveedor</label>
                        <select class="form-control" name="provider_id" id="provider_id">
                          @foreach ($providers as $provider)
                          <option value="{{$provider->id}}"
                          
                          @if($provider->id == $product->provider_id){
                            selected
                          }
                          @endif
                          
                          >{{$provider->name}}</option>
                          @endforeach
                        </select>
                    </div>

                    @if ($errors->has('provider_id'))
                    <span class="text-danger">{{ $errors->first('provider_id') }}</span>
                     @endif
              </div>


              <div class="form-group col-md-6">


                    <div class="form-group">
                        <label for="provider_id">Unidad Medida</label>
                        <select class="form-control" name="unit_id" id="unit_id">
                          @foreach ($units as $unit)
                          <option value="{{$unit->id}}"
                          
                          @if($unit->id == $product->unit_id){
                            selected
                          }
                          @endif
                          
                          >{{$unit->name}}</option>
                          @endforeach
                        </select>
                    </div>

                    @if ($errors->has('unit_id'))
                    <span class="text-danger">{{ $errors->first('unit_id') }}</span>
                     @endif
              </div>

            </div>
              


                     <div class="card-body">
                        <h4 class="card-title d-flex">Imagen de producto
                          <small class="ml-auto align-self-end">
                            <a href="dropify.html" class="font-weight-light" target="_blank">Seleccionar Archivo</a>
                          </small>
                        </h4>
                        <input type="file"  name="picture" id="picture" class="dropify" />
                    </div>
                 

                    @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                     @endif



                <button type="submit" class="btn btn-warning mr-2">Actualizar</button>
                
                <a href="{{route('products.index')}}" class="btn btn-light">Cancelar</a>


                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('melody/js/dropify.js') !!}
@endsection


