@extends('layouts.admin')

<style type="text/css">
  .icon_edit{
    padding-top: 8px;
  }
</style>

@section('title','Gestión de productos')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Productos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Productos</li>
            </ol>
        </nav>

        
    </div>
    <a href="{{route('products.create')}}">
   <span class="btn btn-primary md-5" style=" margin-bottom:15px;">+ Crear Producto</span>
    </a>
    <br>
    <div class="row">

   

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Productos</h4>
                      

                      <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                             
                            <a class="dropdown-item" href="{{route('print_barcode')}}">Exportar códigos de barras</a> 
                             
                            </div>
                          </div>
                    
                      </div>
               

                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                 
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Stock</th>
                                    <th>Categoria</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>
                                        <a href="{{route('products.show',$product)}}">{{$product->name}}</a>
                                    </td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->category->name}}</td>
                                    
                                    @if($product->status == 'ACTIVE')

                                    <td>
                                    
                                    <a class="btn btn-success" style="" href="{{route('change.status.products', $product)}}" title="Cambiar Estado">
                                            Activo <i class="fas fa-check"></i>
                                        </a>

                                    </td>

                                    @else
                                    <td>
                                        <a class="btn btn-danger" href="{{route('change.status.products', $product)}}" title="Cambiar Estado">
                                            Desactivado <i class="fas fa-times"></i>
                                        </a>
                                    </td>

                                    @endif



                                    <td style="width: 50px;">
                                        {!! Form::open(['route'=>['products.destroy',$product], 'method'=>'DELETE']) !!}

                                        @csrf


                                        <a class="btn btn-success" href="{{route('products.edit', $product->id)}}" style="height:35px;width:50px" title="Editar">
                                            <i class="fas fa-pencil-alt btn-icon-append icon_edit"></i>
                                        </a>

                                        <a class="btn btn-info" href="{{route('products.show',$product)}}" style="height:35px;width:50px" type="submit" title="Ver detalle producto">
                                            <i class="fas fa-eye icon_edit"></i>
                                        </a>
                                        
                                        <button class="btn btn-danger eliminar " style="height:35px;width:50px" href="{{route('products.destroy', $product->id)}}" type="submit" title="Eliminar">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                 <div class="card-footer text-muted">
                 
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
@endsection


