<div class="form row">
<div class="form-group col-md-6">
    <label for="provider_id">Proveedor</label>
    <select class="form-control" name="provider_id" id="provider_id">
        @foreach ($providers as $provider)
        <option value="{{$provider->id}}">{{$provider->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-6">
<label for="price">Porcentaje Impuesto</label>
        <div class="input-group">
        <div class="input-group-prepend">
             <span class="input-group-text">%</span> 
            </div>            
     <input type="number" name="tax" id="tax" class="form-control" value="0" aria-describedby="helpId" required>          
</div>
    @if ($errors->has('tax'))
    <small class="text-danger">{{ $errors->first('tax') }}</small>
    @endif
</div>

</div>

<div class ="form row">
<div class="form-group col-md-6">
    <label for="product_id">Producto</label>
    <select class="form-control" name="product_id" id="product_id">
        @foreach ($products as $product)
        <option value="{{$product->id}}">{{$product->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-6">
    <label for="quantity">Cantidad</label>
    <input type="number" name="quantity" id="quantity" class="form-control" aria-describedby="helpId">

    @if ($errors->has('quantity'))
    <small class="text-danger">{{ $errors->first('quantity') }}</small>
    @endif
</div>

</div>

<div class="form row">
    <div class="form-group col-md-6">
        <label for="price">Precio Compra</label>
        <div class="input-group">
        <div class="input-group-prepend">
             <span class="input-group-text">$</span> 
            </div>            
       <input type="number" name="price" id="price" step=0.01 class="form-control" aria-label="Amount (to the nearest dollar)">               
</div>
    
    @if ($errors->has('price'))
    <small class="text-danger">{{ $errors->first('price') }}</small>
    @endif
</div>


<div class="form-group col-md-6">
<label for="price">Porcentaje Comision</label>
        <div class="input-group">
        <div class="input-group-prepend">
             <span class="input-group-text">%</span> 
            </div>            
    <input type="number" name="comission_percent" id="comission_percent" class="form-control" value=20 aria-describedby="helpId"  required>             
</div>
    @if ($errors->has('comission'))
    <small class="text-danger">{{ $errors->first('comission') }}</small>
    @endif
</div>

<div class="form-group col-md-12">
    <label for="description">Fecha Registro</label>

    
    <input type="date" class="form-control" name="purchase_date" id="purchase_date" placeholder="" required >
    </div>
    
</div>

<input type="hidden" id="comission_prod" name="comission_prod">

<input type="hidden" id="comission_total" name="comission_total">

<div class="form-group">
<button type="button" id="agregar" class="btn btn-primary float-left">Agregar producto</button>
<br>
<br>
<br>
</div>


<div class="form-group mt-2">

<h4 class="card-title"><strong>Detalles de compra</h4></strong>
    <div class="table-responsive col-md-12">
                <!--Mandar a llamar en JS por ID !-->
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Producto</th>
                    <th>Precio(US)</th>
                    <th>Cantidad</th>
                    <th>Comision</th>
                    <th>SubTotal(US)</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="5">
                        <p align="right">TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">$ 0.00</span> </p>
                    </th>
                </tr>
                <tr>
                    <th colspan="5">
                        <p align="right">TOTAL IMPUESTO $:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">$ 0.00</span></p>
                    </th>
                </tr>
                <tr>
                    <th colspan="5">
                        <p align="right">TOTAL COMISION $:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_comision">$ 0.00</span></p>
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


<script>
 $(document).ready(function () {
        $("#agregar").click(function () {
            asignar_comision_detalle();
            agregar();
        });
    });
    
    var cont = 0;
    total = 0;
    //Aray subtotales
    subtotal = [];
    comision = 0;
    com = [];
   
    $("#guardar").hide();
 
   
    function agregar() {
    
        product_id = $("#product_id").val();
        producto = $("#product_id option:selected").text();
        quantity = $("#quantity").val();
        price = $("#price").val();
        impuesto = $("#tax").val();
        comission_percent = $('#comission_percent').val();
    
        //comission_total = $('#comission_prod').val();
        //alert(comission_total);


        if (product_id != "" && impuesto!="" && comission_percent!= "" && quantity != "" && quantity > 0 && price != "" || product_id != product_id) {
           
           //Calculando total
            subtotal[cont] = quantity * price;
            total = total + subtotal[cont];
            
            //Calculado Comision
            com[cont] = (price * quantity * comission_percent)/100;
            comision = comision + com[cont];

            var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="product_id[]" value="'+product_id+'">'+producto+'</td> <td> <input type="hidden" id="price[]" name="price[]" value="' + price + '"> <input class="form-control" type="number" id="price[]" value="' + price + '" disabled> </td>  <td> <input type="hidden" name="quantity[]" value="' + quantity + '"> <input class="form-control" type="number" value="' + quantity + '" disabled> </td>  <td> <input type="hidden" name="comission[]" value="' + comission + '"> <input class="form-control" type="number" value="' + comission + '" disabled> </td>  <td align="right">s/' + subtotal[cont] + ' </td></tr>';
            cont++;
            limpiar();
            asignar_comision_detalle();
            totales();
            evaluar();
            $('#detalles').append(fila);
        } else {
            Swal.fire({
                type: 'error',
                text: 'Rellene todos los campos del detalle de la compras',
    
            })
        }
    }

    function asignar_comision_detalle(){
        let comission_percent = $('#comission_percent').val();
        let cantidad_prod = $('#quantity').val();
        let price = $('#price').val();

        comission = (price * cantidad_prod * comission_percent)/100;


        document.getElementById("comission_prod").value = comission.toFixed(2);
    }
    
    function limpiar() {
        $("#quantity").val("");
        $("#price").val("");
    }
    
    function totales() {
        impuesto = $("#tax").val();

        $("#total").html("US " + total.toFixed(2));
        if(impuesto == 0){
           //total_impuesto = total_impuesto;
            total_impuesto = 0;
        }

        else{
            total_impuesto = total * impuesto / 100;
        }

        total_comision = comision; 
       
        total_pagar = total + total_impuesto;
        $("#total_impuesto").html("$" + total_impuesto.toFixed(2));
        $("#total_comision").html("$" + total_comision.toFixed(2));
        $("#total_pagar_html").html("$" + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));

        document.getElementById("comission_total").value = total_comision.toFixed(2);
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
        total_impuesto = total * impuesto / 100;
        total_pagar_html = total + total_impuesto;
        $("#total").html("$" + total);
        $("#total_impuesto").html("$" + total_impuesto);
        $("#total_pagar_html").html("$" + total_pagar_html);
        $("#total_pagar").val(total_pagar_html.toFixed(2));
        $("#fila" + index).remove();
        evaluar();
    }
    
 

</script>

@endsection

