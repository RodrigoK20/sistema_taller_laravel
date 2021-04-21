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
        padding-bottom:20px;
        
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
        background: #0971CE;
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
        background: #0971CE;
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
#picture{
    margin-bottom: 15px;
}

.page-break {
    page-break-after: always;
}


</style>

<body>
    <header>
       <div id="logo">
      
        </div>  
        <div>
            <table id="datos">
                <thead>
                    <tr>
                
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <p id="proveedor">
                                Nombre: {{$business->name}}<br>
                                
                                Teléfono: {{$business->phone}}
                            </p>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>


        <div id="fact">
        <img src="{{ public_path("image/".$business->logo) }}" alt="" style="width: 150px; height: 120px;">
            {{--  <p>
                {{$sale->user->types_identification}}-VENTA
                <br>
                {{$sale->user->id}}
            </p>  --}}
            <p>
          
              
                <br>
                <br>
          
            </p>
        </div>
    </header>
    <br>
    <br>



        <!-- Datos FECHAS !-->
       
        <section>
        <p><strong>Datos reporte</strong></p>
        <div>
            <table id="faccomprador" class="tablaprov ">
                <thead>
                    <tr id="fv">
                        <th>FECHA INICIAL </th>
                        <th>FECHA FINAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center" class="tddetalle">{{$fi}}</td>
                        <td style="text-align:center" class="tddetalle">{{$ff}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <br>


    <p><strong>Detalle de Compras</strong></p>

    <section>
        <div>
            <table id="facproducto">
                <thead>
                    <tr id="fa">
                         <th style="text-align:center">FECHA COMPRA</th>
                         <th style="text-align:center">PRODUCTO</th>
                        <th style="text-align:center">CANTIDAD</th>
                        <th style="text-align:center">COMISION</th>
                        <th style="text-align:center">PRECIO COMPRA($)</th> 
                        <th style="text-align:center">PRECIO VENTA($)</th>
                        <th style="text-align:center">PROVEEDOR</th>
                        <th style="text-align:center">TOTAL COMPRA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($query_purchases as $purchaseDetail)
                    <tr>
                        <td style="text-align:center"  class="tddetalle"> {{\Carbon\Carbon::parse($purchaseDetail->purchase_date)->format('d - M - Y ')}}</td>
                        <td style="text-align:center"  class="tddetalle">{{$purchaseDetail->product}}</td>
                        <td style="text-align:center"  class="tddetalle">{{$purchaseDetail->quantity}}</td>
                        <td style="text-align:center" class="tddetalle">${{$purchaseDetail->comission}}</td>
                        <td style="text-align:center"  class="tddetalle">${{$purchaseDetail->price_purchase}}</td>
                        <td style="text-align:center"  class="tddetalle">${{$purchaseDetail->sell_price}}</td>
                        <td style="text-align:center"  class="tddetalle">{{$purchaseDetail->proveedor}}</td>
                        <td style="text-align:center"  class="tddetalle">${{number_format($purchaseDetail->total,2)}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>


                <tr>
                        <th colspan="7">
                            <p align="right">CANTIDAD COMPRAS REALIZADAS:</p>
                        </th>
                        <td>

                        @foreach($cantidad_compras as $cantidad) 

                        <p align="right">{{$cantidad->cantidadcompras}}</p>

                        @endforeach

                        </td>
                    </tr>

                 <tr>
                        <th colspan="7">
                            <p align="right">COMISION TOTAL PRODUCTOS:</p>
                        </th>
                        <td>
                        <p align="right">${{$total_comision}}</p>
                        </td>
                    </tr>

                
                    <tr>
                        <th colspan="7">
                            <p align="right">TOTAL COMPRAS:</p>
                        </th>
                        <td>
                            <p align="right">${{$total_compras}}</p>
                        </td>
                    </tr>
                    

                  
                </tfoot>
            </table>
        </div>
    </section>


    <br>

 


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