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

<div class="form-group">
        <label for="discount">Fecha de venta</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2">DÍA-MES-AÑO</span>
            </div>
            <input type="date" class="form-control" name="sale_date" id="sale_date" placeholder="" required >
        </div>
    </div>

<div class="form-group">
    <label for="client_id">Cliente</label>
    <select class="form-control" name="client_id" id="client_id">
        @foreach ($clients as $client)
        <option value="{{$client->id}}">{{$client->name}}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
  <label for="code">Código de barras</label>
  <input type="text" name="code" id="code" class="form-control" placeholder="" aria-describedby="helpId">
</div>


<div class="form-row">
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="product_id">Producto</label>
              <!-- <select class="form-control selectpicker" data-live-search="true" name="product_id" id="product_id">   -->
             <select class="form-control" name="product_id" id="product_id1">
                <option value="" disabled selected>Selecccione un producto</option>
                @foreach ($products as $product)
                <option value="{{$product->id}}" >{{$product->name}} - {{$product->unit->name}}</option>
                <!-- <option value="{{$product->id}}_{{$product->stock}}_{{$product->sell_price}}_{{$product->code}}">{{$product->name}}</option> -->
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="">Stock actual</label>
            <input type="text" name="" id="stock" value="" class="form-control" disabled>
          </div>
    </div>
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="price">Precio de venta</label>
            <input type="number" class="form-control" name="price" id="price" aria-describedby="helpId" disabled>
        </div>
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="quantity">Cantidad</label>
            <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="helpId">
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="tax">Impuesto</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">%</span>
            </div>
            <input type="number" class="form-control" name="tax" id="tax" aria-describedby="basic-addon3" value="0" disabled>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="discount">Porcentaje de descuento</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2">%</span>
            </div>
            <input type="number" class="form-control" name="discount" id="discount" aria-describedby="basic-addon2" value="0">
        </div>
    </div>


  </div>



  <!-- Checkbox -->
  <i class="fas fa-car fa-4x" ></i> <br><br>
<div class="form-check form-check-success">
    <strong><label class="form-check-label">
        <input type="checkbox" id="checkbox" value="1" class="form-check-input" onclick="validate_checkbox();">
        Agregar Servicio Taller
        </label></strong> 
 </div>


 <input id="checkbox_value" name="checkbox_value" type="hidden" value="">

 <input id="last_purchase_price" name="last_purchase_price" type="hidden" step="0.01" value="">

 <br>

  <!-- <input id="result_product_id" type="number" value=""> -->

  <div class="form-group">
<button type="button" id="agregar" class="btn btn-primary float-left">Agregar producto</button>

<button type="button" id="btn_cambio" data-toggle="modal" data-target="#cambio" class="btn btn-info float-right"><i class="fas fa-dollar-sign"> Consultar Cambio</i></button>


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
                    <th>Producto</th>
                    <th>Precio Venta ($)</th>
                    <th >Descuento</th>
                    <th>Cantidad</th>
                    <th>Ganancia</th>
                    <th style="width:5%;">SubTotal(US)</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="6">
                        <p align="right" >TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">$ 0.00</span> </p>
                    </th>
                </tr>
                <tr>
                    <th colspan="6">
                        <p align="right">TOTAL IMPUESTO (13%):</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">$ 0.00</span></p>
                    </th>
                </tr>
                <tr>
                    <th colspan="6">
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
       //document.getElementById("mySelect").selectedIndex = "-1";
        document.getElementById("product_id1").selectedIndex = "-1";
    });

    $("#consultarcash").click(function () {
        cambio_cash();
    });

});
var cont = 1;
total = 0;
subtotal = [];
$("#guardar").hide();
$("#btn_cambio").hide();

/* //Mostrar valores del producto segun el select
$("#product_id").change(mostrarValores);
function mostrarValores() {
    datosProducto = document.getElementById('product_id').value.split('_');
    $("#price").val(datosProducto[2]);
    $("#stock").val(datosProducto[1]);
   // $("#code").val(datosProducto[3]);
  
} */

//SOLUCION ERROR: CAMBIAR NOMBRE DEL SELECT YA QUE TENIAN EL MISMO ID
var product_id1 = $('#product_id1');

product_id1.change(function(){

    var valor = $("#product_id1").val();
    var texto = $("#detalles").val();

    if (texto.split("\n").indexOf(valor) < 0 ){
     $("#detalles").val(texto + valor + "\n");

     $.ajax({
            url: "{{route('get_products_by_id')}}",
            method: 'GET',
            data:{
                product_id: product_id1.val(),
            },
            success: function(data){
                console.log(data);
                $("#price").val(data.products.sell_price);
                $("#stock").val(data.products.stock);
                $("#code").val(data.products.code);
                $('#last_purchase_price').val(data.result[0].price); 
        },
     
    });
    
  }
  else{
    Swal.fire({
                type: 'error',
                text: 'El producto ya se encuentra agregado a la venta!',
            })

  }
  
     
}); 


//Obtener codigo barra de producto por code
$(obtener_registro());

function obtener_registro(code){
    $.ajax({
        url: "{{route('get_products_by_barcode')}}",
        type: 'GET',
        data:{
            code: code
        },
        dataType: 'json',
        success:function(data){
            console.log(data);
            $("#price").val(data.products.sell_price);
            $("#stock").val(data.products.stock);
            $('#product_id1').val(data.products.id);
            $('#last_purchase_price').val(data.result[0].price); 
        }
    });
}
$(document).on('keyup', '#code', function(){
    var valorResultado = $(this).val();
    if(valorResultado!=""){
        obtener_registro(valorResultado);
    }else{
        obtener_registro();
    }
})

function agregar() {
    datosProducto = document.getElementById('product_id1').value.split('_');
    product_id = datosProducto[0];
    producto = $("#product_id1 option:selected").text();
    quantity = $("#quantity").val();
    discount = $("#discount").val();
    price = $("#price").val();
    stock = $("#stock").val();
    impuesto = $("#tax").val();

    //Obteniendo ultimo precio compra segun fecha.
    last_price = $('#last_purchase_price').val();

    gain = (price - last_price) * quantity;

 
    //Var para verificar si no esta vacio
    client_id = $("#client_id option:selected").val();
    
    if (product_id != "" && quantity != "" && quantity > 0 && discount != "" && price != "" && client_id > 0 && impuesto != "") {
           // validacion();
        if (parseInt(stock) >= parseInt(quantity)) {
            subtotal[cont] = (quantity * price) - (quantity * price * discount / 100);
            total = total + subtotal[cont];
            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" id="prod" name="product_id[]" value="' + product_id + '">' + producto + '</td> <td> <input type="hidden" name="price[]" value="' + parseFloat(price).toFixed(2) + '"> <input class="form-control" type="number" value="' + parseFloat(price).toFixed(2) + '" disabled> </td> <td> <input type="hidden" name="discount[]" value="' + parseFloat(discount) + '"> <input class="form-control" type="number" value="' + parseFloat(discount) + '" disabled> </td> <td> <input type="hidden" name="quantity[]" value="' + quantity + '"> <input type="number" value="' + quantity + '" class="form-control" disabled> </td> <td> <input type="hidden" name="gain[]" value="' + gain + '"> <input type="number" value="' + gain + '" class="form-control" disabled> </td> <td align="right">s/' + parseFloat(subtotal[cont]).toFixed(2) + '</td></tr>';
            cont++;
            limpiar();
            totales();
            evaluar();
            
            $('#detalles').append(fila);
          
            
        } else {
            Swal.fire({
                type: 'error',
                text: 'La cantidad a vender supera el stock actual del producto.',
            })
        }
    } else {
        Swal.fire({
            type: 'error',
            text: 'Ingrese todos los campos correctamente del detalle de la venta.',
        })
    }
}



function limpiar() {
    $("#quantity").val("");
    $("#discount").val("0");
    $("#price").val("");
    $("#stock").val("");
    $("#code").val("");

}
function totales() {
    $("#total").html("$ " + total.toFixed(2));
        
        if(impuesto == 0){
            //total_impuesto = total_impuesto;
            total_impuesto = 0;
        }

        else{
            total_impuesto = total * impuesto / 100;
        }

    total_pagar = total + total_impuesto;
    $("#total_impuesto").html("$ " + total_impuesto.toFixed(2));
    $("#total_pagar_html").html("$ " + total_pagar.toFixed(2));
    $("#total_pagar").val(total_pagar.toFixed(2));
}
function evaluar() {
    if (total > 0) {
        $("#guardar").show();
        $('#btn_cambio').show();
    } else {
        $("#guardar").hide();
         $('#btn_cambio').show();
    }
}
function eliminar(index) {
    total = total - subtotal[index];
    total_impuesto = total * impuesto / 100;
    total_pagar_html = total + total_impuesto;
    $("#total").html("$" + total);
    $("#total_impuesto").html("$" + total_impuesto);
    $("#total_pagar_html").html("$" + total_pagar_html);
    $("#total_pagar").val(total_pagar_html.toFixed(2));
    $("#fila" + index).remove();
    evaluar();
    
}


function validate_checkbox(){
    if(document.getElementById('checkbox').checked){

       var checkedValue = document.querySelector('#checkbox:checked').value;
       //var value = document.getElementById("checkbox_value").value = 1;
        document.getElementById('checkbox_value').value = checkedValue;
       // alert(checkedValue);
    }

    else{
        $('#checkbox_value').val(0);
    }
}



function cambio_cash(){

    totalapagar = $("#total_pagar").val();
    cash_client = document.getElementById('cash_client').value;

    let resultado = cash_client - totalapagar;

    if(resultado >0){

        Swal.fire({
            type: 'info',
            title: 'Cambio ',
            text: 'El cambio del cliente es: $'+resultado.toFixed(2),
            confirmButtonText:
             '<i class="fa fa-thumbs-up"></i> De acuerdo!',
            footer: 'Speed Service'
        })

        $('#cambio').modal('hide');
        
    }

    else{
  
        Swal.fire({
                type: 'error',
                text: 'Ingrese la cantidad correcta dada por el cliente',
            })

    }

}


</script>


@endsection


