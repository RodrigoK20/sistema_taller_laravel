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
        background: #33AFFF;
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
                        <th id="">DATOS DEL VENDEDOR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <p id="proveedor">
                                Nombre: {{$sale->user->name}}<br>
                                
                                Email: {{$sale->user->email}}
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
                NUMERO DE VENTA
                <br>
                {{$sale->id}}
            </p>
        </div>
    </header>
    <br>
    <br>

    <!-- Datos Cliente !-->

    <section>
        <div>
            <table id="faccomprador" class="tablaprov">
                <thead>
                    <tr id="fv">
                        <th>CLIENTE</th>
                        <th>FECHA Y HORA VENTA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center" class="tddetalle">{{$sale->user->name}}</td>
                        <td style="text-align:center" class="tddetalle">{{$sale->created_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <br>

    <p><strong>Detalle de Venta</strong></p>

    <section>
        <div>
            <table id="facproducto">
                <thead>
                    <tr id="fa">
                        <th style="text-align:center">CANTIDAD</th>
                        <th style="text-align:center">PRODUCTO</th>
                        <th style="text-align:center">GANANCIA</th> 
                        <th style="text-align:center">PRECIO VENTA($)</th>
                        <th style="text-align:center">DESCUENTO(%)</th>
                        <th style="text-align:center">SUBTOTAL($)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($saleDetails as $saleDetail)
                    <tr>
                        <td style="text-align:center"  class="tddetalle">{{$saleDetail->quantity}}</td>
                        <td style="text-align:center"  class="tddetalle">{{$saleDetail->product->name}}</td>
                        <td style="text-align:center" class="tddetalle">${{$saleDetail->gain}}</td>
                        <td style="text-align:center"  class="tddetalle">${{$saleDetail->price}}</td>
                        <td style="text-align:center"  class="tddetalle">%{{$saleDetail->discount}}</td>
                        <td style="text-align:center"  class="tddetalle">${{number_format($saleDetail->quantity*$saleDetail->price - $saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100,2)}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>

                 <tr>
                        <th colspan="5">
                            <p align="right">GANANCIA PRODUCTOS:</p>
                        </th>
                        <td>
                            <p align="right">$ {{number_format($total_ganancia,2)}}</p>
                        </td>
                    </tr>
                    
  <!--                   <tr>
                        <th colspan="4">
                            <p align="right">SUBTOTAL:</p>
                        </th>
                        <td>
                            <p align="right">s/ {{number_format($subtotal,2)}}</p>
                        </td>
                    </tr>
                   
                    <tr>
                        <th colspan="4">
                            <p align="right">TOTAL IMPUESTO ({{$sale->tax}}%):</p>
                        </th>
                        <td>
                            <p align="right">s/ {{number_format($subtotal*$sale->tax/100,2)}}</p>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="4">
                            <p align="right">TOTAL PAGAR:</p>
                        </th>
                        <td>
                            <p align="right">s/ {{number_format($sale->total,2)}}</p>
                        </td>
                    </tr> -->

                  
                </tfoot>
            </table>
        </div>
    </section>


    <br>

<p><strong>Detalle de Servicios Taller</strong></p>

<section>
    <div>
        <table id="facproducto">
            <thead>
                <tr id="fa">
                    <th style="text-align:center">VEHICULO</th>
                    <th style="text-align:center">SERVICIO TALLER</th>
                    <th style="text-align:center">CATEGORIA SERVICIO</th>
                    <th style="text-align:center">MANO DE OBRA ($)</th>
                    <th style="text-align:center">FECHA</th>
                
                </tr>
            </thead>
            <tbody>
             @foreach($serviceDetails as $serviceDetail)
                     <tr>
                     <td style="text-align:center"  class="tddetalle">{{$serviceDetail->car->license_plate}}</td>
                      <td style="text-align:center"  class="tddetalle">{{$serviceDetail->workshop->name_service}}</td>
                      <td style="text-align:center"  class="tddetalle">{{$serviceDetail->workshop->categorywork->name}}</td>
                     <td style="text-align:center"  class="tddetalle">${{$serviceDetail->total_service}}</td>
                     <td style="text-align:center"  class="tddetalle">{{$serviceDetail->service_date}}</td>
                     </td>
                    </tr>
             @endforeach
            </tbody>
            <tfoot>
                
                 <tr>
                    <th colspan="4">
                        <p align="right">SUBTOTAL:</p>
                    </th>
                    <td>
                        <p align="right">${{number_format($subtotal,2)}}</p>
                    </td>
                </tr>
               
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL IMPUESTO ({{$sale->tax}}%):</p>
                    </th>
                    <td>
                        <p align="right">${{number_format($subtotal*$sale->tax/100,2)}}</p>
                    </td>
                </tr>

                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL DETALLE VENTA:</p>
                    </th>
                    <td>
                        <p align="right">${{number_format($sale->total,2)}}</p>
                    </td>
                </tr> 

                   <tr>
                        <th colspan="4">
                         <p align="right">TOTAL SERVICIOS TALLER:</p>
                        </th>
                     <th>
                     <p align="right">${{number_format($subtotalserv,2)}}</p>
                         </th>
                </tr>

                <tr>
                     <th colspan="4">
                     <p align="right" style="color:red;">TOTAL FACTURA:</p>
                     </th>
                     <th>
                 <p align="right">${{number_format($sale->total + $sale->total_service_dealer,2)}} </p>
                        </th>
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