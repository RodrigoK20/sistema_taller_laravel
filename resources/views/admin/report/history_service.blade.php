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
        margin-right: 15%;
        font-size: 20px;
        background: '';
        text-align:center;
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
        background: #3e8727;
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
        background: #3e8727;
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
                        <th id="">DATOS DEL VEHICULO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <p id="proveedor">
                                Vehiculo: {{$car->brand}} {{$car->model}}<br>
                                Año: {{$car->year}}<br>
                                Viscosidad: {{$car->viscosity}}<br>
                                Placa: {{$car->license_plate}}<br>
                                
                            
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
               CANTIDAD DE SERVICIOS REALIZADOS
                <br>

                @foreach($cantidad as $carcantidad) 

                <p style="margin-right: 20;">{{$carcantidad->cantidad}}</p>

                    @endforeach
              
            </p>
        </div>
    </header>
    <br>
    <br>
   

    <!-- Datos Cliente !-->


    <section>
    <p><strong>Información cliente</strong></p>
        <div>
            <table id="faccomprador" class="tablaprov">
                <thead>
                    <tr id="fv">
                        <th>CLIENTE</th>
                        <th>TELEFONO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center" class="tddetalle">{{$client->name}}</td>
                        <td style="text-align:center" class="tddetalle">{{$client->phone}}</td>
                    </tr>
                </tbody>
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
                     <th style="text-align:center">FECHA</th>
                    <th style="text-align:center">SERVICIO TALLER</th>
                    <th style="text-align:center">CATEGORIA SERVICIO</th>
                    <th style="text-align:center">TOTAL</th>
                    
                
                </tr>
            </thead>
            <tbody>
             @foreach($cars as $serviceDetail)
                     <tr>
                     <td style="text-align:center"  class="tddetalle">{{$serviceDetail->service_date}}</td>
                     <td style="text-align:center"  class="tddetalle">{{$serviceDetail->servicio}}</td>
                     <td style="text-align:center"  class="tddetalle">{{$serviceDetail->categoria}}</td>
                     <td style="text-align:center"  class="tddetalle">${{$serviceDetail->total_service}}</td>

                     </td>
                    </tr>
             @endforeach
            </tbody>
            <tfoot>
                
                
                     <tr>
                     <th colspan="3">
                                            <p align="right">TOTAL: </p>
                                        </th>
                        <td colspan="4" align="left"><strong>  ${{$total_services}}</strong></td>
                    
                    
                    </tr> 
                     



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