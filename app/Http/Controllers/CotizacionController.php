<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\CotizacionDetails;
use App\Client;
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
        //
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
}
