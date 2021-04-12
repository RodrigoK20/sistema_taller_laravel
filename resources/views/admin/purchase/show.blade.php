@extends('layouts.admin')
@section('title','Detalles de Compra')




<style type="text/css">
#myModal {
    width:100%;
    height: 100%;
   
    margin:0 auto;
}
.modal1{
 width:100%;
}
.modal-dialog,.modal-dialog img {
    width:100%;
    height:40%;
    margin:0 auto;
 
}

</style>


@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Detalles de compra
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="#">Compras</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles de compra</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   
                    <div class="form-group row">
                        <div class="col-md-3 text-center">
                            <label class="form-control-label" for="nombre"><strong>Proveedor</strong></label>
                            <p>{{$purchase->provider->name}}</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <label class="form-control-label" for="num_compra"><strong>Número Compra</strong></label>
                            <p>{{$purchase->id}}</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <label class="form-control-label" for="num_compra"><strong>Comprador</strong></label>
                            <p>{{$purchase->user->name}}</p>
                        </div>

                        <div class="col-md-3 text-center">
                            <label class="form-control-label" for="num_compra"><strong>Fecha Compra</strong></label>
                            <p>{{$purchase->purchase_date}}</p>
                        </div>

                    </div>
                    <br /><br />
                    <div class="form-group row ">
                        <h4 class="card-title ml-3">Detalles de compra</h4>
                        <div class="table-responsive col-md-12">
                            <table id="detalles" class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio ($)</th>
                                        <th>Cantidad</th>
                                        <th>Comision</th>
                                        <th>SubTotal ($)</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">
                                            <p align="right">SUBTOTAL:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($subtotal,2)}}</p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">
                                            <p align="right">TOTAL IMPUESTO ({{$purchase->tax}}%):</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($subtotal*$purchase->tax/100,2)}}</p>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="4">
                                            <p align="right" style="">TOTAL COMISION:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($purchase->comission_total,2)}}</p>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="4">
                                            <p align="right">TOTAL:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($purchase->total,2)}}</p>
                                        </th>
                                    </tr>
                    
                                </tfoot>
                                <tbody>
                                    @foreach($purchaseDetails as $purchaseDetail)
                                    <tr>
                                        <td>{{$purchaseDetail->product->name }}</td>
                                        <td>${{$purchaseDetail->price}}</td>
                                        <td>{{$purchaseDetail->quantity}}</td>
                                        <td>${{$purchaseDetail->comission}}</td>
                                        <td>${{number_format($purchaseDetail->quantity*$purchaseDetail->price,2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal">
                      <span class="btn btn-warning">Comprobante</span>
                    </a>
                    
                    
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('purchases.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>



<div class="modal1">
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title " id="myModalLabel">Comprobante</h4>

            </div>
            <div class="modal-body">
                <p>
                    <img class='img-responsive' src="{{asset('image/purchases/'.$purchase->picture)}}" alt="Sin comprobante"  />
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection






