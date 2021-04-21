<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

use App\Sale;
use App\Client;
use App\Product;
use App\User;
use App\Business;
use App\Workshop;
use App\Purchase;
use App\PurchaseDetails;
use App\Car;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
  
    public function index()
    {
        //
    }

  
    public function create(Request $request)
    {
        $sales = Sale::get();
        $clients = Client::get();
        $products = Product::where('status','=','ACTIVE')->get();
        $cars = Car::where('status','=','ACTIVE')->get();
        $workshops = Workshop::where('status', 'ACTIVE')->get();
        
        return view('admin.sale.create2', compact('sales','clients','products','cars','workshops'));
    }

 
    public function store(Request $request)
    {   
        //dd($request);

        $sale = Sale::create([
            'user_id'=>Auth::user()->id,
            'total_service_dealer'=>0,
            //'sale_date'=>Carbon::now('America/El_Salvador'),
            'sale_date'=>$request->service_date,
            'tax'=>0,
            'total'=>0,
            'status'=>'VALID',
            'client_id'=>$request->client_id,
        ]);

       // dd($sale);

       //Obteniendo ultimo ID de la tabla Sale para guardarlo en Services
       $id_sale =  $sale->id;
      // dd($id_sale);

       $workshop_id = $request->workshop_id;
       $car_id = $request->car_id;
       //dd($car_id);
       $cost = $request->cost;
       //$date_service = Carbon::now('America/El_Salvador');
       $date_service = $request->service_date;
       $client_id = $sale->client_id;
       //Guardando datos a la tabla Services
       //dd($request->cost);
       $count = 0;
       while($count < count($workshop_id)){
           $details = new Service();
           $details->sale_id = $id_sale;
           $details->service_date = $date_service;
           $details->total_service = $cost[$count];
           $details->workshop_id = $workshop_id[$count];
           $details->client_id = $client_id;
           $details->car_id = $car_id[$count];
           $details->user_id = Auth::user()->id;
           $details->save();
           $count = $count+1;
       } 

      // dd($service);
       //Actualizando Precio del servicio a la factura (tabla Sale campo total_service_dealer)
       $time_update = Carbon::now('America/El_Salvador');
       $total_service = $request->total;
       $data = Sale::find($id_sale);
       $data->total_service_dealer = $total_service;
       $data->updated_at = $time_update;
       $data->save();

      return redirect()->route('sales.index');


    }

 
    public function show(Service $service)
    {
        //
    }

 
    public function edit(Service $service)
    {
        //
    }


    public function update(Request $request, Service $service)
    {
        //
    }

 
    public function destroy(Service $service)
    {
        //
    }
}
