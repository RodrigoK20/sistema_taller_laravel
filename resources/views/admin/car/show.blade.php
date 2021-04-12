@extends('layouts.admin')
@section('title','Detalle de Vehiculo')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            {{$car->brand}}   {{$car->model}}   {{$car->year}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('cars.index')}}">Vehiculos</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$car->brand}}</li>
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
                                <h3>{{$car->license_plate}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                                <div class="list-group">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list"
                                        data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                        Informacion Vehiculo
                                    </a>

                                    <a class="list-group-item list-group-item-action" id="list-photo-list"
                                        data-toggle="list" href="#list-photo" role="tab" aria-controls="photo">
                                        Fotografía
                                    </a>
                               
                                    <a class="list-group-item list-group-item-action" id="list-profile-list"
                                        data-toggle="list" href="#list-service" role="tab" aria-controls="service">
                                        Historial de servicios taller
                                    </a>

                               

                                    {{--  <button type="button" class="list-group-item list-group-item-action">Registrar
                                        producto</button>  --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 pl-lg-5">




                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" user="tabpanel"
                                    aria-labelledby="list-home-list">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Información del vehiculo</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
                                            
                                            <div class="form-group col-md-6">
                                                <strong><i class="fab fa-product-hunt mr-1"></i> Marca</strong>
                                                <p class="text-muted">
                                                    {{$car->brand}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-address-card mr-1"></i> Modelo</strong>
                                                <p class="text-muted">
                                                    {{$car->model}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-burn mr-1"></i> Viscosidad</strong>
                                                <p class="text-muted">
                                                    {{$car->viscosity}}
                                                </p>
                                  
                                            </div>
        
                                            <div class="form-group col-md-6">
                                                <strong>
                                                    <i class="fas fa-tachometer-alt mr-1"></i>
                                                    Placa</strong>
                                                <p class="text-muted">
                                                    {{$car->license_plate}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-car mr-1"></i> Año</strong>
                                                <p class="text-muted">
                                                    {{$car->year}}
                                                </p>
                                                <hr>
                                         
                                                <hr>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                         <!--Fotografia vehiculo -->

                                         <div class="tab-pane fade" id="list-photo" user="tabpanel"
                                    aria-labelledby="list-photo-list">


                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Historial de Servicios Taller</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                    
                                    <img src="{{asset('image/cars/'.$car->picture)}}" alt="Photo Car" width="900px"  />

                                    </div>

                                </div>
               

                            <!--Historial Servicios taller -->

                                <div class="tab-pane fade" id="list-service" user="tabpanel"
                                    aria-labelledby="list-profile-list">


                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Historial de Servicios Taller</h4>

                                            <a class="btn btn-info" href="{{route('cars.pdf', $car)}}" title="Reporte Servicios Taller">
                                            <i class="fas fa-file-pdf"></i> Reporte Historico Servicios Taller 
                                         </a>
                                                        <br>

                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">

                                     
    
                                            <div class="table-responsive">
                                                <table id="order-listing" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Fecha</th>
                                                            <th>Servicio</th>
                                                            <th>Total</th>
                                                           
                                                            <!-- <th style="width:50px;">Acciones</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($carServices as $car)
                                                        <tr>
                                                            <th scope="row">
                                                                <a href="{{route('sales.show', $car)}}">{{$car->id}}</a>
                                                            </th>
                                                            <td>{{$car->service_date}}</td>
                                                            <td>{{$car->workshop->name_service}}</td>
                                                            <td>${{$car->total_service}}</td>
                        
                                           <!-- 
                                                            <td style="width: 50px;">
                        
                                                                <a href="{{route('cars.pdf', $car)}}" class="jsgrid-button jsgrid-edit-button"><i class="far fa-file-pdf"></i></a>
                                                                <a href="{{route('sales.show', $car)}}" class="jsgrid-button jsgrid-edit-button"><i class="far fa-eye"></i></a>
                                                              
                                                            </td> -->
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                          <td colspan="2"><strong>Total en servicios taller: </strong></td>
                                                          <td colspan="3" align="left"><strong>${{$total_services}}</strong></td>
                                                        </tr>

                                                        

                                                    </tfoot>
                                                </table>
                                            </div>
    
                                        </div>
                                    </div>

                                </div>







                            </div> 





                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('cars.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection




@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
@endsection
