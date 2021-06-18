@extends('layouts.admin')

<style type="text/css">
    .icon_edit3 {
        padding-top: 8px;
    }

    
</style>

@section('title','Cotización Taller') @section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Cotización Taller
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Panel administrador</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Cotización Taller</li>
            </ol>
        </nav>

    </div>

    <br>
    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cotización</h4>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                id="home-tab"
                                data-toggle="tab"
                                href="#index"
                                role="tab"
                                aria-controls="index"
                                aria-selected="true">
                                <i class="fas fa-bars"></i>
                                Listado de Cotizaciónes</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="profile-tab"
                                data-toggle="tab"
                                href="#add"
                                role="tab"
                                aria-controls="profile-1"
                                aria-selected="false">
                                <i class="fas fa-plus-circle"></i>
                                Agregar Cotización</a>
                        </li>
                        <!-- <li class="nav-item"> <a class="nav-link" id="contact-tab"
                        data-toggle="tab" href="#report" role="tab" aria-controls="contact-1"
                        aria-selected="false"><i class="fas fa-chart-line"></i> Informes</a> </li> -->
                    </ul>

                    <!-- Index !-->
                    <div class="tab-content">
                        <div
                            class="tab-pane fade show active"
                            id="index"
                            role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="media">

                                <div class="media-body">

                                    <div class="table-responsive">
                                        <table id="order-listing" class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha Cotizacion</th>
                                                    <th>Cliente</th>
                                                    <th>Vehiculo</th>
                                                    <th>PDF</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($cotizacion as $cot)
                                                <tr>
                                                    <th scope="row">{{$cot->id}}</th>
                                                    <td>
                                                        {{$cot->date}}
                                                    </td>
                                                    <td>{{$cot->client->name}}</td>
                                                    <td>{{$cot->car->brand }}
                                                        {{$cot->car->model}}
                                                        {{$cot->car->license_plate}}</td>

                                                    <td style="width: 50px;">

                                                        <a
                                                            class="btn btn-warning icon_edit "
                                                            style="height:30px;width:50px"
                                                            href="{{route('cotizacions.boleta', $cot)}}"
                                                            type="submit"
                                                            title="Cotizacion">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="add"
                            role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="media">
                                <br>
                                <div class="media-body">
                                    <h4 class="mt-0">Agregar Cotización</h4>
                                    <br>
                                    <a href="{{route('cotizacions.create')}}">
                                        <span class="btn btn-primary md-5" style=" margin-bottom:15px;">+ Agregar Cotización</span>
                                    </a>
                                    <br>

                                    @endsection

@section('scripts')
{!! Html::script('melody/js/data-table2.js') !!}
@endsection