@extends('layouts.admin')

<style type="text/css">
  .icon_edit{
    padding-top: 8px;
  }
</style>

@section('title','Gestión de clientes')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Clientes
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>

        
    </div>
    <a href="{{route('clients.create')}}">
    <span class="btn btn-primary md-5" style=" margin-bottom:15px;">+ Crear Clientes</span>
    </a>
    <br>
    <div class="row">



        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Clientes</h4>
                      

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
                                 
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>DUI</th>
                                    <th>Teléfono/Celular</th>
                                    <th>Correo electronico</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <th scope="row">{{$client->id}}</th>
                                    <td>
                                        <a href="{{route('clients.show',$client)}}">{{$client->name}}</a>
                                    </td>
                                    <td>{{$client->dui}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->email}}</td>

                                    <td style="width: 50px;">
                                        {!! Form::open(['route'=>['clients.destroy',$client], 'method'=>'DELETE']) !!}

                                        @csrf


                                        <a class="btn btn-success" href="{{route('clients.edit', $client->id)}}" style="height:35px;width:50px" title="Editar">
                                            <i class="fas fa-pencil-alt btn-icon-append icon_edit"></i>
                                        </a>
                                        
                                        <button class="btn btn-danger eliminar " style="height:35px;width:50px" href="{{route('clients.destroy', $client->id)}}" type="submit" title="Eliminar">
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


