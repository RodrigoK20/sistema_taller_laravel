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

<div class="form-row">
    <div class="form-group col-md-12">

    <label for="client_id">Vehiculo</label>
    <select class="form-control" name="car_id" id="car_id1">
        @foreach ($cars as $car)
        <option value="{{$car->id}}">{{$car->license_plate}}</option>
        @endforeach
    </select>
</div>

</div>

<div class="form-group col-md-6">


</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="workshop">Servicio taller</label>
              <!-- <select class="form-control selectpicker" data-live-search="true" name="product_id" id="product_id">   -->
             <select class="form-control" name="workshop_id" id="workshop_id1">
                <option value="" disabled selected>Selecccione un producto</option>
                @foreach ($workshops as $workshop)
                <option value="{{$workshop->id}}" >{{$workshop->name_service}}</option>
              
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="">Mano de Obra ($)</label>
            <input type="text" name="cost" id="cost" value="" class="form-control" disabled>
          </div>
    </div>
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="price">Descripción</label>
            <textarea type="number" class="form-control" name="" id="description" aria-describedby="helpId" disabled> </textarea>
        </div>
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

<h4 class="card-title"><strong>Detalles de venta</h4></strong>
    <div class="table-responsive col-md-12">
                <!--Mandar a llamar en JS por ID !-->
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th style="width:30%;">Servicio</th>
                    <th style="width:25%;">Mano de Obra ($)</th>
                    <th style="width:25%;" >Placa</th>
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

//SELECT CHANGE Y OBTENER DATOS
workshop_id1.change(function(){
        $.ajax({
            url: "{{route('get_workshops_by_id')}}",
            method: 'GET',
            data:{
                workshop_id: workshop_id1.val(),
            },
            success: function(data){
                console.log(data);
                $("#cost").val(data.cost);
                $("#description").val(data.description);
              
        }
    });
}); 


function agregar() {
    datosServicio= document.getElementById('workshop_id1').value.split('_');

    workshop_id = datosServicio[0];
    servicio = $("#workshop_id1 option:selected").text();
    cost = $("#cost").val();

    car_id = $("#car_id1").val();
    license_plate = $("#car_id1 option:selected").text();

    if (workshop_id != "" && cost != "" && cost > 0) {
        if (parseInt(cost) >0) {
            subtotal[cont] = parseFloat(cost);
            total = total + subtotal[cont];
            //alert(total);
            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="workshop_id[]" value="' + workshop_id + '">' + servicio + '</td> <td> <input type="hidden" name="cost[]" value="' + parseFloat(cost).toFixed(2) + '"> <input class="form-control" type="number" value="' + parseFloat(cost).toFixed(2) + '" disabled> </td> <td> <input type="hidden" name="car_id[]" value="' + car_id + '"> <input type="string" value="' + license_plate + '" class="form-control" disabled> </td>  <td>  <td align="right">s/' + parseFloat(subtotal[cont]).toFixed(2) + '</td></tr>';
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



