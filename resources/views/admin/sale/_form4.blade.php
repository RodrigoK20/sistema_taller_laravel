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


                    <div class="form-group">
                      <label for="name">Nombre Producto/Repuesto</label>
                      <input type="text" class="form-control" name="name_product" id="name_product" placeholder="Nombre Producto/Repuesto" >
                    </div>

                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
                    <br>
                    <div class="form-group">
                      <label for="description">Precio</label>
                      <input type="number" step="0.01" class="form-control" name="price" id="price" placeholder="Precio" >
                    </div>
                  <br>
                    @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                     @endif


                     <div class="form-group">
                      <label for="description">Cantidad</label>
                      <input type="number" min="1" class="form-control" pattern="^[0-9]+" name="quantity" id="quantity" placeholder="Cantidad"  >
                    </div>

                    <div class="form-group">
                      <!-- ID SALE !-->
                      <input type="hidden" class="form-control" value="{{$sale->id}}"  name="sale_id" id="sale_id" placeholder=""  >
                    </div>

</div>


<div class="form-group">
<button type="button" id="agregar" class="btn btn-primary float-left">Agregar servicio</button>

<br>
<br>
<br>

</div>

<div class="form-group mt-2">

<h4 class="card-title"><strong>Detalles de Repuestos</h4></strong>
    <div class="table-responsive col-md-12">
                <!--Mandar a llamar en JS por ID !-->
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Repuesto</th>
                    <th>Cantidad</th>
                    <th>Precio ($)</th>
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
$("#guardar").hide();





function agregar() {
  
    price = $("#price").val();
    quantity = $("#quantity").val();
    name_product = $("#name_product").val();
    sale_id = $("#sale_id").val();


    if (price != "" && quantity != "" && quantity > 0 && name_product !="") {
        if (parseInt(price) >0 && quantity>0) {
            subtotal[cont] = parseFloat(price) * quantity;
            total = total + subtotal[cont];
            //alert(total);
            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times fa-2x"></i></button></td> <input type="hidden" name="sale_id[]" value="' + sale_id + '">  <td> <input type="hidden" name="name_product[]" value="' + name_product + '"> <input class="form-control" type="string" value="' + name_product + '" disabled> </td>       <td> <input type="hidden" name="quantity[]" value="' + quantity + '"> <input class="form-control" type="number" value="' + quantity + '" disabled> </td> <td> <input type="hidden" name="price[]" value="' +  parseFloat(price).toFixed(2) + '"> <input class="form-control" type="number" value="' +  parseFloat(price).toFixed(2) + '" disabled> </td>  <td>  <td align="right">s/' + parseFloat(subtotal[cont]).toFixed(2) + '</td></tr>';
            cont++;
            limpiar();
            totales();
            evaluar();
            $('#detalles').append(fila);
            
        } else {
            Swal.fire({
                type: 'error',
                text: 'El precio y la cantidad debe ser mayor a cero',
            })
        }
    } else {
        Swal.fire({
            type: 'error',
            text: 'Rellene todos los campos del detalle de gastos.',
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

function limpiar(){
    $('#quantity').val("");
    $('#price').val("");
    $('#name_product').val("");
}




</script>

@endsection



