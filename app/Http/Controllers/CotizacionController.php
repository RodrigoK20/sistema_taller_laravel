<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\CotizacionDetails;
use App\Client;
use App\Business;
use App\Car;

use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;

class CotizacionController extends Controller
{
   
    public function index()
    {
        $cotizacion = Cotizacion::orderBy('date', 'DESC')->get();
     
        return view('admin.cotizacion.index',compact('cotizacion'));
    }

  
    public function create()
    {
        $clients = Client::get();
        return view('admin.cotizacion.create', compact('clients'));
    }

 
    public function store(Request $request)
    {

        //dd($request->total);

        $cotizacion = Cotizacion::create([
            'date'=>$request->date,
            'total'=>$request->total,
            'client_id'=>$request->client_id,
            'car_id'=>$request->car_id,
        ]);

        //Obteniendo ultimo ID de la tabla Cotizacion para guardarlo en cotizacion_details
       $id_cotizacion =  $cotizacion->id;
    
 
        $product = $request->product;
        $price = $request->price;
        $quantity = $request->quantity;
      
        $count = 0;
        while($count < count($product)){
            $details = new CotizacionDetails();
            $details->cotizacion_id = $id_cotizacion;
            $details->product = $product[$count];
            $details->price = $price[$count];
            $details->quantity = $quantity[$count];
           
            $details->save();
            $count = $count+1;
        } 

        $total = $request->total;
        $data = Cotizacion::find($id_cotizacion);
        $data->total = $total;
        $data->save();
 
       return redirect()->route('cotizacions.index');

    }

  
    public function show(Cotizacion $cotizacion)
    {

       
    }


    public function edit(Cotizacion $cotizacion)
    {
        //
    }

 
    public function update(Request $request, Cotizacion $cotizacion)
    {
        //
    }


    public function destroy(Cotizacion $cotizacion)
    {
        //
    }

    public function pdf_cotizacion(Cotizacion $cot){
         //REPORTE COTIZACION 
        //dd($cot);

        $imagen_anulado = "anulado.png";

        //Acceder al detalle de la cotizacion segun RELACION
        $cotizacionDetails = $cot->cotizacionDetails;

        //Datos Empresa
        $business = Business::where('id',1)->firstOrFail();

        //Datos cliente
        $client = Client::where('id',$cot->client_id)->firstOrFail();

        //Datos Carro
        $car = Car::where('id',$cot->car_id)->firstOrFail();
        
        //Datos usuario
        //$user = User::where('id', $sale->user_id)->firstOrFail();

    
        $pdf = PDF::loadView('admin.cotizacion.report', compact('cotizacionDetails','business','client','car','cot','imagen_anulado'));
        return $pdf->download('Cotizacion '.$client->name. ' '.$cot->date. '.pdf');
    }
}
