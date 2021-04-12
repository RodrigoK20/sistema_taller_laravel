@extends('layouts.admin')

<style type="text/css">

</style>

@section('title','Detalle servicio taller')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            {{$workshop->name_service}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li> <li class="breadcrumb-item"><a href="#">Servicios Taller</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$workshop->name_service}}</li>
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
                                <h3>{{$workshop->name_service}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                                <div class="list-group">
                                    <button type="button" class="list-group-item list-group-item-action active">
                                        Sobre servicio de taller
                                    </button>
                                    
                                    <div class="d-flex justify-content-center">

                                    <i class="fas fa-car fa-10x"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 pl-lg-5">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Información de servicio taller</h4>
                                </div>
                            </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">

                                   

                                    <div class="form-group col-md-6">
                                        <strong><i class="fab fa-product-hunt mr-1"></i> Nombre</strong>
                                        <p class="text-muted">
                                            {{$workshop->name_service}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-address-card mr-1"></i> Descripción</strong>
                                        <p class="text-muted">
                                            {{$workshop->description}}
                                        </p>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <strong>
                                            <i class="fas fa-mobile mr-1"></i>
                                            Mano de Obra ($)</strong>
                                        <p class="text-muted">
                                            {{$workshop->cost}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-envelope mr-1"></i> Categoria Servicio</strong>
                                        <p class="text-muted">
                                            {{$workshop->categorywork->name}}
                                        </p>
                                        <hr>
                                    
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('workshops.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
@endsection


