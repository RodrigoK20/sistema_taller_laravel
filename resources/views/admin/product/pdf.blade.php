<!DOCTYPE>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Reporte de venta</title>
<style>
    body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif;
        font-size: 14px;
        /*font-family: SourceSansPro;*/
    }
    #datos {
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
    }
    #encabezado {
        text-align: center;
        margin-left: 35%;
        margin-right: 35%;
        font-size: 15px;
    }
    #fact {
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        background: '';
    }
    section {
        clear: left;
    }
    #cliente {
        text-align: left;
    }
    #facliente {
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }
    #fac,
    #fv,
    #fa {
        color: #FFFFFF;
        font-size: 15px;
    }
    #facliente thead {
        padding: 20px;
        background: #D2691E;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
    }
    #facvendedor {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }
    #facvendedor thead {
        padding: 20px;
        background: #D2691E;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }
    #facproducto {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }
    #facproducto thead {
        padding: 20px;
        background: #D2691E;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }

    #faccomprador {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }
    #faccomprador thead {
        padding: 20px;
        background: #33AFFF;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }


     .tbodydetalle {

        border: 1px solid black;
        
    }
    
    .tabladatos, .tddetalle,  {
    border: 1px solid black;
}
    
    #facproducto thead {
        padding: 20px;
        background: #FF5733;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }

    tfoot{
        padding-top: 10px;
    }

    #footer {
    position: fixed;
    bottom: 35;
    width: 100%;
}

    #line{
        position: fixed;
    bottom: 35;
    width: 100%;
    }



</style>

<body>
    <header>
       <div id="logo">
           <!-- -- <img src="{{asset($business->logo)}}" alt="" id="imagen"> -->
        </div>  
        <div>
            <table id="datos">
                <thead>
                    <tr>
                        <th id="">FECHA Y HORA DEL REPORTE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <p id="proveedor">
                                {{$fecha_hora}} 
                            
                            </p>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="fact">
            {{--  <p>
                {{$sale->user->types_identification}}-VENTA
                <br>
                {{$sale->user->id}}
            </p>  --}}
            <p>
                REPORTE INVENTARIO
                <br>
               
            </p>
        </div>
    </header>
    <br>
    <br>
<br>
<br>

    <p><strong>Detalle de Inventario</strong></p>

    <section>
        <div>
            <table id="facproducto">
                <thead>
                    <tr id="fa">
                        <th style="text-align:center">PRODUCTO</th>
                        <th style="text-align:center">STOCK</th>
                        <th style="text-align:center">UNIDAD</th>
                        <th style="text-align:center">CATEGORIA</th> 
                        <th style="text-align:center">PRECIO VENTA($)</th>
                        <th style="text-align:center">PROVEEDOR</th>
                        <th style="text-align:center">COSTO</th>
                        <th style="text-align:center">DI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($query_products as $product)
                    <tr>
                        <td style="text-align:center"  class="tddetalle">{{$product->nombre}}</td>
                        <td style="text-align:center"  class="tddetalle">{{$product->stock}}</td>
                        <td style="text-align:center"  class="tddetalle">{{$product->unidad}}</td>
                        <td style="text-align:center" class="tddetalle">{{$product->categoria}}</td>
                        <td style="text-align:center"  class="tddetalle">${{$product->precio}}</td>
                        <td style="text-align:center"  class="tddetalle">{{$product->proveedor}}</td>
                        <td style="text-align:center"  class="tddetalle">${{$product->costo}}</td>
                        <td style="text-align:center"  class="tddetalle">${{$product->dinero_inv}}</td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>

                 <tr>
                        <th colspan="7">
                            <p align="right">CANTIDAD DE PRODUCTOS EN INVENTARIO:</p>
                        </th>
                        <td>
                        @foreach ($cantidad_productos as $prod)
                            <p align="right">{{$prod->cantidad}}</p>
                        </td>
                        @endforeach
                    </tr>

         
                    <tr>
                        <th colspan="7">
                            <p align="right"> TOTAL DINERO EN INVENTARIO:</p>
                        </th>
                        <td>
                   
                            <p align="right">${{$total_di}}</p>
                        </td>
                   
                    </tr>
                  
                  
                </tfoot>
            </table>
        </div>
    </section>






    <br>
    <br>
    <footer>
    <hr id="line">
       
        <div id="footer">
            <p id="encabezado">
                <b>{{$business->name}}</b><br>{{$business->description}}<br>Telefono: {{$business->phone}}<br>Email: {{$business->mail}}  
            </p>
        </div>
    </footer>
</body>

</html>