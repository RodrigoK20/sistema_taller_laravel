<!DOCTYPE>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Reporte de compra</title>
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
        background: #33AFFF;
    }
    section {
        clear: left;
    }
    #cliente {
        text-align: left;
    }
    #faproveedor {
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
    #faproveedor thead {
        padding: 20px;
        background: #33AFFF;
        text-align: left;
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
    #facproducto {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
       
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
        {{--  <div id="logo">
            <img src="img/logo.png" alt="" id="imagen">
        </div>  --}}
        <div>
            <table id="datos" >
                <thead>
                    <tr>
                        <th id="">DATOS DEL PROVEEDOR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <p id="proveedor">Nombre: {{$purchase->provider->name}}<br>
                                {{--  {{$purchase->provider->document_type}}-COMPRA: {{$purchase->provider->document_number}}<br>  --}}
                                Dirección: {{$purchase->provider->address}}<br>
                                Teléfono: {{$purchase->provider->phone}}<br>
                                Email: {{$purchase->provider->email}}</p>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="fact">
                <p>NUMERO DE COMPRA<br />
                    {{$purchase->num_factura}}</p>
        </div>
    </header>
    <br>

   
    <br>
    <br>
    <section>
        <div>
            <table id="faccomprador" class="tablaprov">
                <thead>
                    <tr id="fv">
                        <th>COMPRADOR</th>
                        <th>FECHA COMPRA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center" class="tddetalle">{{$purchase->user->name}}</td>
                        <td style="text-align:center" class="tddetalle">{{$purchase->purchase_date}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <br>
    <section>
        <div>
        <div id="tabladatos">
            <table id="facproducto" class="table1">
                <thead>
                    <tr id="fa">
                        <th style="text-align:center">CANTIDAD</th>
                        <th>PRODUCTO</th>
                        <th>MEDIDA</th>
                        <th style="text-align:center">COMISION</th>
                        <th style="text-align:center">PRECIO COMPRA</th>
                        <th style="text-align:center">SUBTOTAL ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseDetails as $purchaseDetail)
                    <tr class="row">
                       <td class="tddetalle" style="text-align:center">{{$purchaseDetail->quantity}}</td>
                        <td class="tddetalle" style="text-align:center">{{$purchaseDetail->product->name}}</td>
                        <td class="tddetalle" style="text-align:center">{{$purchaseDetail->product->unit->name}}</td>
                        <td class="tddetalle" style="text-align:center">${{$purchaseDetail->comission}}</td>
                        <td class="tddetalle" style="text-align:center">${{$purchaseDetail->price}}</td>
                        <td class="tddetalle" style="text-align:center">${{number_format($purchaseDetail->quantity*$purchaseDetail->price,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </div>
            <br>
                <tfoot >
                 
                    <tr>
                        <th colspan="5" class="thdetalle">
                            <p align="right">SUBTOTAL:</p>
                        </th>
                        <td>
                            <p align="right">${{number_format($subtotal,2)}}<p>
                        </td>
                    </tr>
                  
                    <tr>
                        <th colspan="5" class="thdetalle">
                            <p align="right">TOTAL IMPUESTO ({{$purchase->tax}}%):</p>
                        </th>
                        <td>
                            <p align="right">$ {{number_format($subtotal*$purchase->tax/100,2)}}</p>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="5" class="thdetalle">
                            <p align="right">COMISION TOTAL:</p>
                        </th>
                        <td>
                            <p align="right">${{number_format($comision_total,2)}}</p>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="5" class="thdetalle">
                            <p align="right">TOTAL PAGADO:</p>
                        </th>
                        <td>
                            <p align="right">${{number_format($purchase->total,2)}}<p>
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


