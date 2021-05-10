<div class ="form row">

<div class="form-group col-md-6">
<label for="client_id">Cliente</label>
    <select class="form-control" name="client_id" id="client_id1">
    <option value="" disabled selected>Selecccione un cliente</option>
        @foreach ($clients as $client)
        <option value="{{$client->id}}">{{$client->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-6">
    <label for="quantity">Vehículo</label>
    <select class="form-control" name="car_id" id="car_id1">
       
       </select>

       <small>Agregar un vehículo por cotización</small>
</div>

</div>


<div class ="form row">

<div class="form-group col-md-6">
    <label for="quantity">Cantidad</label>
    <input type="number" name="quantity" id="quantity" class="form-control" aria-describedby="helpId">

    @if ($errors->has('quantity'))
    <small class="text-danger">{{ $errors->first('quantity') }}</small>
    @endif
</div>



<div class="form-group col-md-6">
        <label for="price">Precio</label>
        <div class="input-group">
        <div class="input-group-prepend">
             <span class="input-group-text">$</span> 
            </div>            
       <input type="number" name="price" id="price" step=0.01 class="form-control" aria-label="Amount (to the nearest dollar)">               
</div>

</div>




<div class="form-group col-md-6">

<label for="product">Producto / Repuesto</label>
        <div class="input-group">
                    
    <input type="text" name="product" id="product" class="form-control"  aria-describedby="helpId"  >             

    
</div>
    @if ($errors->has('comission'))
    <small class="text-danger">{{ $errors->first('comission') }}</small>
    @endif

    
</div>

<div class="form-group col-md-6">
<label for="price">Fecha Cotización</label>
        <div class="input-group">
                    
        <input type="date" class="form-control" name="date" id="date" placeholder="" required >

    
</div>

</div>


    

<!-- SELECT CATEGORIA SERVICIO -->

<div class="form-group col-md-6">

<label for="workshop">Categoria Taller</label>
              <!-- <select class="form-control selectpicker" data-live-search="true" name="product_id" id="product_id">   -->
             <select class="form-control" name="category_id" id="category_id1">
                <option value="" disabled selected>Selecccione una categoria de taller</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}" >{{$category->name}}</option>
              
                @endforeach
            </select>

    
</div>

<div class="form-group col-md-6">
    <label for="client_id">Servicio</label>
    <select class="form-control" name="service_id" id="service_id1">
   
    </select>
</div>







</div>

<div class="form-group">
<button type="button" id="agregar" class="btn btn-primary float-left">Agregar producto</button>
<br>
<br>
<br>
</div>


<div class="form-group mt-2">

<h4 class="card-title"><strong>Detalles de cotización</h4></strong>
    <div class="table-responsive col-md-12">
                <!--Mandar a llamar en JS por ID !-->
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                     <th>Eliminar</th>
                    <th>Producto/Servicio</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th style="width:1%;">SubTotal(US)</th>
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
                        <p align="right">TOTAL COTIZACIÓN:</p>
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


<script>
 $(document).ready(function () {
        $("#agregar").click(function () {
            agregar();
        });
    });
    
    var cont = 0;
    total = 0;
    //Array subtotales
    subtotal = [];
   
   
    $("#guardar").hide();


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
                //console.log(data);
                let cars = $("#car_id1");
                cars.empty();
                $(data.result).each(function(index, value){ 
                   cars.append(`<option value="${value.id}">${value.license_plate}</option>`);
                 
                })
                             
        }
    });
}); 



var category_id1 = $('#category_id1');

//SELECT CATEOGORIA TALLER Y OBTENER SERVICIOS ASOCIADOS A LA CATEGORIA 
category_id1.change(function(){
        $.ajax({
            url: "{{route('get_services_by_id')}}",
            method: 'GET',
            data:{
                category_id: category_id1.val(),
            },
            success: function(data){
                //console.log(data);
                $("#price").val(data.result[0].cost);
                $("#product").val(data.result[0].name_service);
                $("#quantity").val(1);

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
                $("#price").val(data.result[0].cost);
                $("#product").val(data.result[0].name_service);
                $("#quantity").val(1);

        },
     
    });
    
  
}); 



    function agregar() {
    
      //  product_id = $("#product_id").val();
        product = $("#product").val();
        quantity = $("#quantity").val();
        price = $("#price").val();
        fecha = $('#date').val();
        
        if (quantity>0 && fecha != "" && price>0 && product != "") {
           
           //Calculando total
            subtotal[cont] = quantity * price;
            total = total + subtotal[cont];
            
        
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times"></i></button></td><td> <input type="hidden" id="product[]" name="product[]" value="' + product + '"> <input class="form-control" type="string" id="product[]" value="' + product + '" disabled> </td> <td> <input type="hidden" id="price[]" name="price[]" value="' + price + '"> <input class="form-control" type="number" id="price[]" value="' + parseFloat(price).toFixed(2) + '" disabled> </td>  <td> <input type="hidden" name="quantity[]" value="' + quantity + '"> <input class="form-control" type="number" value="' + quantity + '" disabled> </td>   <td align="right">s/' + parseFloat(subtotal[cont]).toFixed(2) + ' </td></tr>';
            cont++;
            limpiar();
            totales();
            evaluar();
            $('#detalles').append(fila);
        } else {
            Swal.fire({
                type: 'error',
                text: 'Rellene todos los campos del detalle de la cotización',
    
            })
        }
    }

    
    function limpiar() {
        $("#quantity").val("");
        $("#price").val("");
        $("#product").val("");
    }
    
    function totales() {
 
        $("#total").html("$ " + total.toFixed(2));
        total_pagar = total ;
   
        $("#total_pagar_html").html("$ " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
      
    }
    
    function evaluar() {
        if (total > 0) {
            $("#guardar").show();
        } else {
            $("#guardar").hide();
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
    
 

</script>

@endsection

