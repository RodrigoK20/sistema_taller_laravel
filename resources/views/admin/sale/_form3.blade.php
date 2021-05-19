@section('styles')
{!! Html::style('select/dist/css/bootstrap-select.min.css') !!}
<style type="text/css">
    .unstyled-button {
        border: none;
        padding: 0;
        background: none;
    }
</style>
@endsection

<!-- PANTALLA AGREGAR SOLO SERVICIO TALLER-->
<div class="form-row">
    <div class="form-group col-md-6">

    <label for="client_id"><strong>Cliente</strong></label>
    <select class="form-control" name="client_id" id="client_id1">
    <option value="" disabled selected>Selecccione un cliente</option>
        @foreach ($clients as $client)
        <option value="{{$client->id}}">{{$client->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-6">
    <label for="client_id"><strong>Vehículo</strong></label>
    <select class="form-control" name="car_id" id="car_id1">
       
    </select>
</div>

</div>

<div class="form-row">
    <div class="form-group col-md-6">

    <label for="workshop"><strong>Categoría Taller</strong></label>
              <!-- <select class="form-control selectpicker" data-live-search="true" name="product_id" id="product_id">   -->
             <select class="form-control" name="workshop_id" id="workshop_id1">
                <option value="" disabled selected>Selecccione una categoria de taller</option>
                @foreach ($workshops as $workshop)
                <option value="{{$workshop->id}}" >{{$workshop->name}}</option>
              
                @endforeach
            </select>
</div>

<div class="form-group col-md-6">
    
    <label for="client_id"><strong>Servicio</strong></label>
    <select class="form-control" name="service_id" id="service_id1">
   
    </select>
</div>

</div>



<div class="form-row">
 
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for=""><strong>Mano de Obra ($)</strong></label>
            <input type="text" name="cost" id="cost" value="" class="form-control" disabled>
          </div>
    </div>
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="price"><strong>Descripción</strong></label>
            <textarea type="number" class="form-control" name="" id="description" aria-describedby="helpId" disabled> </textarea>
        </div>
    </div>
  </div>

  
    <div class="form-group">
        <label for="discount"><strong>Descripción del Servicio realizado</strong></label>
        <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
        <textarea class="form-control" id="service_description" name="service_description" name rows="4"></textarea>
    </div>


    <div class="form-group">
        <label for="discount"><strong>Fecha de servicio</strong></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2">DÍA-MES-AÑO</span>
            </div>
            <input type="date" class="form-control" name="service_date" id="service_date" placeholder="" required >
        </div>
    </div>


  <!-- Checkbox -->
  <i class="fas fa-dollar-sign fa-3x" ></i> <br><br>
<div class="form-check form-check-success">
    <strong><label class="form-check-label">
        <input type="checkbox" id="checkbox" class="form-check-input" onclick="validate_checkbox();">
        Modificar Costo Mano de Obra $
        </label></strong> 
 </div>
 <br>


  <div class="form-group">
<button type="button" id="agregar" class="btn btn-primary float-left">Agregar servicio</button>
<br>
<br>
<br>

 

</div>

<div class="form-group mt-2">

<h4 class="card-title"><strong>Detalles de Servicio</h4></strong>
    <div class="table-responsive col-md-12">
                <!--Mandar a llamar en JS por ID !-->
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Servicio</th>
                    <th>Placa</th>
                    <th>Mano de Obra ($)</th>
                    <th style="width:5%;">SubTotal(US)</th>
                </tr>
            </thead>
            <tfoot>

                 <tr>
                    <th colspan="5">
                        <p align="right" >TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">$ 0.00</span> </p>
                    </th>
                </tr>


                <tr>
                    <th colspan="5">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <th>
                        <p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden"
                                name="total" id="total_pagar"></p>
                    </th>
                </tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>

</div>


@section('scripts')

{!! Html::script('melody/js/alerts.js') !!}
{!! Html::script('melody/js/avgrund.js') !!}

{!! Html::script('melody/js/sweetalert2.js') !!}
{!! Html::script('select/dist/js/bootstrap-select.min.js') !!}


<script>
$(document).ready(function () {
    $("#agregar").click(function () {
        agregar();
    });
});

var cont = 1;
total = 0;
subtotal = [];
$("#guardar2").hide();


var workshop_id1 = $('#workshop_id1');

//SELECT CATEOGORIA TALLER Y OBTENER SERVICIOS ASOCIADOS A LA CATEGORIA 
workshop_id1.change(function(){
        $.ajax({
            url: "{{route('get_services_by_id')}}",
            method: 'GET',
            data:{
                category_id: workshop_id1.val(),
            },
            success: function(data){
                console.log(data);
                $("#cost").val(data.result[0].cost);
                $("#description").val(data.result[0].description);
                

                let services = $("#service_id1");
                services.empty();
                $(data.result).each(function(index, value){ 
                    services.append(`<option value="${value.id}">${value.name_service}</option>`);
                 
                })

                             
        }
    });
});

//SELECT SERVICIOS TALLER, CARGAR NOMBRE Y PRECIO MANO DE OBRA
var service_id1 = $('#service_id1');

service_id1.change(function(){

   
     $.ajax({
            url: "{{route('get_service_data_by_id')}}",
            method: 'GET',
            data:{
                service_id: service_id1.val(),
            },
            success: function(data){
               // console.log(data);
                $("#cost").val(data.result[0].cost);

        },
     
    });
    
  
}); 


var client_id1 = $('#client_id1');

//SELECT CLIENTE Y OBTENER VEHICULOS ASOCIADOS AL CLIENTE
client_id1.change(function(){
        $.ajax({
            url: "{{route('get_cars_by_id')}}",
            method: 'GET',
            data:{
                client_id: client_id1.val(),
            },
            success: function(data){
                console.log(data);
                let cars = $("#car_id1");
                cars.empty();
                $(data.result).each(function(index, value){ 
                   cars.append(`<option value="${value.id}">${value.license_plate}</option>`);
                 
                })

                             
        }
    });
}); 


function agregar() {
    datosServicio= document.getElementById('service_id1').value.split('_');

    workshop_id = datosServicio[0];
    servicio = $("#service_id1 option:selected").text();
    cost = $("#cost").val();
    car_id = $("#car_id1").val();
    license_plate = $("#car_id1 option:selected").text();

    if (workshop_id != "" && cost != "" && cost > 0 && license_plate !="") {
        if (parseInt(cost) >0) {
            subtotal[cont] = parseFloat(cost);
            total = total + subtotal[cont];
            //alert(total);
            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="workshop_id[]" value="' + workshop_id + '">' + servicio + '</td> <td> <input type="hidden" name="car_id[]" value="' + car_id + '"> <input type="string" value="' + license_plate + '" class="form-control" disabled> </td> <td> <input type="hidden" name="cost[]" value="' + parseFloat(cost).toFixed(2) + '"> <input class="form-control" type="number" value="' + parseFloat(cost).toFixed(2) + '" disabled> </td>  <td>  <td align="right">s/' + parseFloat(subtotal[cont]).toFixed(2) + '</td></tr>';
            cont++;
            limpiar();
            totales();
            evaluar();
            $('#detalles').append(fila);
            
        } else {
            Swal.fire({
                type: 'error',
                text: 'El costo debe ser mayor a cero',
            })
        }
    } else {
        Swal.fire({
            type: 'error',
            text: 'Rellene todos los campos del detalle del servicio del taller.',
        })
    }
}



function totales() {

    $("#total").html("$ " + total.toFixed(2));
    total_pagar = total ;
   
    $("#total_pagar_html").html("$ " + total_pagar.toFixed(2));
    $("#total_pagar").val(total_pagar.toFixed(2));
  
}

function evaluar() {
    if (total > 0) {
        $("#guardar2").show();
    } else {
        $("#guardar2").hide();
    }
}

function eliminar(index) {
    total = total - subtotal[index];
    total_pagar_html = total;
    $("#total").html("$" + total);
    $("#total_pagar_html").html("$" + total_pagar_html);
    $("#total_pagar").val(total_pagar_html.toFixed(2));
    $("#fila" + index).remove();
    evaluar();
}

function limpiar(){
    document.getElementById("workshop_id1").selectedIndex = "-1";
    $('#cost').val("");
}

function validate_checkbox(){
    if(document.getElementById('checkbox').checked){

        document.getElementById("cost").removeAttribute("disabled");

    }

    else{
        document.getElementById("cost").setAttribute("disabled",true);
    }
}


</script>

@endsection



