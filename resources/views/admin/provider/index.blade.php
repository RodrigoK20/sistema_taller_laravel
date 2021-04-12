@extends('layouts.admin')

<style type="text/css">
  .icon_edit{
    padding-top: 8px;
  }
</style>

@section('title','Gestión de proveedores')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Proveedores
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
            </ol>
        </nav>

        
    </div>
    <a href="{{route('providers.create')}}">
    <span class="btn btn-primary md-5" style=" margin-bottom:15px;">+ Crear Proveedor</span>
    </a>
    <br>
    <div class="row">



        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Proveedores</h4>
                      

                      <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                             
                               <a  class="dropdown-item" >Agregar</a>
                             
                            </div>
                          </div>
                    
                      </div>
               

                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>RUC</th>
                                    <th>Telefono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($providers as $provider)
                                <tr>
                                    <th scope="row">{{$provider->id}}</th>
                                    <td>
                                        <a href="{{route('providers.show',$provider)}}">{{$provider->name}}</a>
                                    </td>
                                    <td>{{$provider->email}}</td>
                                    <td>{{$provider->ruc_number}}</td>
                                    <td>{{$provider->phone}}</td>
                                    <td style="width: 50px;">
                                        {!! Form::open(['route'=>['providers.destroy',$provider], 'method'=>'DELETE']) !!}

                                        @csrf


                                        <a class="btn btn-success" href="{{route('providers.edit', $provider->id)}}" style="height:35px;width:50px" title="Editar">
                                            <i class="fas fa-pencil-alt btn-icon-append icon_edit"></i>
                                        </a>
                                        
                                        <button class="btn btn-danger eliminar " style="height:35px;width:50px" href="{{route('providers.destroy', $provider->id)}}" type="submit" title="Eliminar">
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


