<?php

namespace App\Http\Controllers;

use App\Car;
use App\Client;
use App\Business;
use Illuminate\Http\Request;

use App\Http\Requests\Car\StoreRequest;
use App\Http\Requests\Car\UpdateRequest;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\DB;



class CarController extends Controller
{
   
    public function index()
    {
        //Listado de vehichulos
        $cars = Car::get();
        return view('admin.car.index', compact('cars'));
    }

   
    public function create()
    {
       
        $clients = Client::get();
        return view('admin.car.create', compact('clients'));

    }


    public function store(StoreRequest $request)
    {
    
     
        if ($request->picture!=null ) {
                $file = $request->file('picture');
             $image_name = time().'_'.$file->getClientOriginalName();
             $file->move(public_path("/image/cars"),$image_name);

             $car = Car::create($request->all());

             $car->update(['picture'=>$image_name]);

         
          }

          //Agregar vehiculo desde pantalla de venta
          if ($request->sale == 1) {
            Car::create($request->validated()+[
                'client_id'=> $request->client_id,
            ]);
            return redirect()->back();
        }

          else{
            Car::create($request->validated()+[
                'client_id'=> $request->client_id,
            ]);
          }

      
        return redirect()->route('cars.index');




    }

  
    public function show(Car $car)
    {
        //Ver detalle de auto y detalle de servicios 

        //Acceder al relacion carro-servicios
        $carServices = $car->services;

        

        $total_services = 0;
        foreach($car->services as $key => $sale){
            $total_services+= $sale->total_service;
        } 
        
       
        return view('admin.car.show', compact('car','carServices','total_services'));
    }

 
    public function edit(Car $car)
    {
        
        $clients = Client::get();

        return view('admin.car.edit', compact('clients','car'));
    }

 
    public function update(UpdateRequest $request, Car $car)
    {
       
        if ($request->picture!=null ) {
            $file = $request->file('picture');
         $image_name = time().'_'.$file->getClientOriginalName();
         $file->move(public_path("/image/cars"),$image_name);

        //dd($image_name);
         $car->update($request->validated());

         $car->update(['picture'=>$image_name]);

      }

      else{
        $car->update($request->validated()+[
            'client_id'=> $request->client_id,
        ]);
      }

      return redirect()->route('cars.index');


    }

   
    public function change_status(Car $car)
    {
       
        if ($car->status =='ACTIVE') {
            $car->update(['status'=>'DEACTIVATED']);
            return redirect()->back();
        }

        else{
            $car->update(['status'=>'ACTIVE']);
            return redirect()->back();
        }
    }

    public function pdf(Car $car)
    {
         //Acceder al detalle de la compras segun RELACION
         $carDetails = $car->services;

        //Total
            $total_services = 0;
            foreach($car->services as $key => $service){
                 $total_services+= $service->total_service;
            } 

           
        //Cantidad servicios
        $cantidad = DB::select('SELECT COUNT(*) as cantidad FROM services s WHERE s.car_id = :car_id', ['car_id'=>$car->id]);  
     
    
        $client = $car->client;
        $car = $car;

        $cars = DB::select('SELECT s.total_service, s.service_date, ws.name_service as servicio, cw.name as categoria  FROM services s 
        JOIN workshops ws ON ws.id = s.workshop_id JOIN cars c ON c.id = s.car_id JOIN clients cl ON cl.id = s.client_id JOIN category_works cw ON cw.id = ws.category_work_id WHERE s.car_id = :car_id ORDER BY s.service_date DESC', ['car_id'=>$car->id]);

         //Datos Empresa
         $business = Business::where('id',1)->firstOrFail();

         $pdf = PDF::loadView('admin.report.history_service', compact('cars','business','total_services','client','car','cantidad'));
         return $pdf->download('Reporte_historial_servicios'.$car->license_plate.'.pdf');
     
    }
}
