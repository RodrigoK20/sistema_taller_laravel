<?php

namespace App\Http\Controllers;

use App\Client;
use App\Car;
use Illuminate\Http\Request;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;

use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:clients.create')->only(['create','store']);
        $this->middleware('can:clients.index')->only(['index']);
        $this->middleware('can:clients.edit')->only(['edit','update']);
        $this->middleware('can:clients.show')->only(['show']);
        $this->middleware('can:clients.destroy')->only(['destroy']);
    }

    public function index()
    {
        $clients = Client::get();
        return view('admin.client.index', compact('clients'));
    }

   
    public function create()
    {

        return view('admin.client.create');
    }


    public function store(StoreRequest $request)
    {
        Client::create($request->all());
        //Vista registrar venta
        if ($request->sale == 1) {
            return redirect()->back()->with('status','Exito');
        }

        return redirect()->route('clients.index');
    }

 
    public function show(Client $client)
    {

        $clientSales = $client->sales;

        $total_purchases = 0;

        foreach ($clientSales as $sale) {
            $total_purchases  += $sale->total;
        }
        //Acceder al relacion cliente-servicios
        $clientServices = $client->services;

     /*    $total_services = 0;
        foreach($client->sales as $key => $sale){
            $total_services+= $sale->total_service_dealer;
        }  */

        $total_services = 0;

        foreach ($clientServices as $service) {
            $total_services += $service->total_service;
        }
        
       
        return view('admin.client.show', compact('client', 'total_purchases','clientServices','total_services'));
    }

  
    public function edit(Client $client)
    {
        return view('admin.client.edit', compact('client'));
    }

    

    public function update(UpdateRequest $request, Client $client)
    {
        $client->update($request->all());
        return redirect()->route('clients.index');
    }


    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }

    public function get_cars_by_id(Request $request){

        
        if ($request->ajax()) {   
            $result = DB::select("SELECT c.id, c.license_plate FROM cars c WHERE c.status='ACTIVE' AND c.client_id = :client_id", ['client_id'=>$request->client_id]);
            
            return response()->json(['result'=>$result]);
        }

       
    }
}
