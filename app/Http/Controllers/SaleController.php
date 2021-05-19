<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Client;
use App\Product;
use App\User;
use App\Business;
use App\Workshop;
use App\Service;
use App\Purchase;
use App\PurchaseDetails;
use App\Car;
use App\CategoryWork;

use Illuminate\Http\Request;

use App\Http\Requests\Purchase\StoreRequest;
use App\Http\Requests\Purchase\UpdateRequest;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sales.create')->only(['create','store']);
        $this->middleware('can:sales.index')->only(['index']);
        $this->middleware('can:sales.show')->only(['show']);

        $this->middleware('can:change.status.sales')->only(['change_status']);
        $this->middleware('can:sales.pdf')->only(['pdf']);
       
    }

   public function index()
    {
      
        $sales =  Sale::orderBy('sale_date', 'desc')->get();
        //dd($sales);
        return view('admin.sale.index', compact('sales'));

    }

 
    public function create()
    {
        $sales = Sale::get();
        $clients = Client::get();
        $products = Product::where('status','=','ACTIVE')->get();
        
        return view('admin.sale.create', compact('sales','clients','products'));

    }

  
    public function store(StoreRequest $request)
    {
       // dd($request->checkbox_value);
       //dd($request->gain);
       //Si se desea implmentar el porcentaje de impuesto, quitar la linea: 'tax'=>0
        $sale = Sale::create($request->all()+[
            'tax'=>0,
            'user_id'=>Auth::user()->id,
            'total_service_dealer'=>0,
            //'sale_date'=>Carbon::now('America/El_Salvador'),
            'sale_date'=>$request->sale_date,
        ]);
      
        //Detalle VENTA
        foreach($request->product_id as $key =>$product){
            $results[] = array("product_id"=>$request->product_id[$key], "quantity"=>$request->quantity[$key],
            "price"=>$request->price[$key],"discount"=>$request->discount[$key], "gain"=>$request->gain[$key]);

        }
                //Nombre relacion puesto en el modelo
        $sale->saleDetails()->createMany($results);

    
        if($request->checkbox_value == 1){

            //Obtener max ID
            $sale = Sale::orderBy('id', 'desc')->first(); 
            $workshops = CategoryWork::get();
            $cars = Car::where('status','=','ACTIVE')->where('client_id','=',$sale->client_id)->get();
          

             return view('admin.sale.service', compact('sale','workshops','cars'));
        }

        else{

            return redirect()->route('sales.index');
        }

    }
 
    public function show(Sale $sale)
    {
       // dd($sale->service_description);
        //Acceder al detalle de la ventas segun RELACION
        $saleDetails = $sale->saleDetails;
        //dd($saleDetails);
        //Subtotal sin impuesto
        $subtotal = 0;
        
        //Sub
        foreach ($saleDetails as $saleDetail) {
                $subtotal+= $saleDetail->quantity * $saleDetail->price - (
                    $saleDetail->quantity * $saleDetail->price  * $saleDetail->discount/100);
        }


        //Detalle Servicios Taller
        $serviceDetails = $sale->saleServices;
      //  dd($sale->saleServices);

        $subtotalserv = 0;

        foreach ($serviceDetails as $serviceDetail) {
            $subtotalserv+= $serviceDetail->total_service;
           // dd($subtotalserv);
        }

         //Datos gastos repuestos
         $gastosDetails = $sale->saleExpenses;

         $total_expense = 0;

         foreach ($gastosDetails as $gasto) {
             $total_expense += $gasto->price * $gasto->quantity;

         }

        // dd($total_expense);

        return view('admin.sale.show', compact('sale','saleDetails','subtotal','serviceDetails','subtotalserv','gastosDetails','total_expense'));
    }

    
 
    public function edit(Sale $sale)
    {
     
        //Obteniendo datos de Sale
        $sale = Sale::where('id', $sale->id)->first();
        $id = $sale->id;

        //Condicion si ya existe el id en la tabla services, regresar al menu
        $validacion_cliente_servicio = DB::table('services')->where('sale_id',$id)->first('sale_id');
        //dd($validacion_cliente_servicio);

        if($validacion_cliente_servicio != null){

            return redirect()->route('sales.index')->with('status', 'Error');;
        }

        else{

            $workshops = CategoryWork::get();
            $cars = Car::where('status','=','ACTIVE')->where('client_id','=',$sale->client_id)->get();

             return view('admin.sale.service', compact('sale','workshops','cars'));

        }
        
    }

    //Agregar Servicio taller a factura del cliente
    public function update(Request $request, Sale $sale)
    {

        //Obteniendo valores
        $id_sale = $request->sale->id;
       // $total_factura = $request->sale->total;
       // dd($total_factura) dd($request->sale->id) dd($request->cost) dd($request->total) dd($request->workshop_id);

        $workshop_id = $request->workshop_id;
        $car_id = $request->car_id;
        $cost = $request->cost;
        $date_service = $request->sale->sale_date;
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

       //Actualizando Precio del servicio a la factura (tabla Sale campo total_service_dealer)
       $time_update = Carbon::now('America/El_Salvador');
       $total_service = $request->total;
       $data = Sale::find($id_sale);
       $data->total_service_dealer = $total_service;
       $data->service_description = $request->service_description;
       $data->updated_at = $time_update;
       $data->save();

       return redirect()->route('sales.index');

    }

  
    public function destroy(Sale $sale)
    {
        //$purchase->delete();
        //return redirect()->route('categories.index');
    }

    public function pdf(Sale $sale)
    {
        //dd($sale->id);

         //Business data
         $business = Business::where('id',1)->firstOrFail();
    
        //Acceder al detalle de la compras segun RELACION
        $saleDetails = $sale->saleDetails;

        //datos cliente
        $client = $sale->client;

        //Acceder a precio de compra
        //$purchase_product = PurchaseDetails::where('product_id',$saleDetails->product_id)->firstOrFail();
       // dd($purchase_product);

        //Subtotal sin impuesto
        $subtotal = 0;
        
        //Sub
        foreach ($saleDetails as $saleDetail) {
                $subtotal+= $saleDetail->quantity * $saleDetail->price - (
                    $saleDetail->quantity * $saleDetail->price  * $saleDetail->discount/100);
        }

         //Detalle Servicios Taller
        $serviceDetails = $sale->saleServices;
      // dd($sale->saleServices);

        $subtotalserv = 0;

        foreach ($serviceDetails as $serviceDetail) {
            $subtotalserv+= $serviceDetail->total_service;
           // dd($subtotalserv);
        }

        $total_ganancia = 0;
        //Ganancia productos
        foreach ($saleDetails as $saleDetail) {
            $total_ganancia+= $saleDetail->gain;
           // dd($subtotalserv);
        }

        $query_products  = DB::select('SELECT s.id as sale_id,s.sale_date as fecha_venta,s.total as total, s.tax as tax, sl.quantity, sl.price, sl.discount, sl.gain, p.name as producto, p.sell_price, cl.name as cliente, pd.price as costo, u.name as unidad FROM sales s JOIN sale_details sl ON sl.sale_id = s.id JOIN products p ON p.id = sl.product_id 
        JOIN purchase_details pd ON pd.product_id = p.id JOIN units u ON u.id = p.unit_id
        JOIN clients cl ON cl.id = s.client_id  WHERE s.id= :id ORDER BY s.id ASC ', ['id'=>$sale->id]);

         //total costos sumatoria
         $total_costos = 0;

         foreach ($query_products as $saleDetail) {
             $total_costos += $saleDetail->costo * $saleDetail->quantity;
             
         }


        $pdf = PDF::loadView('admin.sale.pdf', compact('subtotal','saleDetails','sale','business', 'serviceDetails','subtotalserv','total_ganancia','total_costos','query_products','client'));
        return $pdf->download('Reporte_de_venta'.$sale->id.'.pdf');
    }

    public function pdf_boleta(Sale $sale)
    {
        $imagen_anulado = "anulado.png";

        //Acceder al detalle de la compras segun RELACION
        $saleDetails = $sale->saleDetails;

        //Subtotal sin impuesto
        $subtotal = 0;
        
        //Sub
        foreach ($saleDetails as $saleDetail) {
                $subtotal+= $saleDetail->quantity * $saleDetail->price - (
                    $saleDetail->quantity * $saleDetail->price  * $saleDetail->discount/100);
        }

        //Datos Empresa
        $business = Business::where('id',1)->firstOrFail();

        //Datos cliente
        $client = Client::where('id',$sale->client_id)->firstOrFail();

        //Datos vendedor
        $user = User::where('id', $sale->user_id)->firstOrFail();

        //Detalle Servicios Taller
        $serviceDetails = $sale->saleServices;
         // dd($sale->saleServices);
     
         $subtotalserv = 0;
     
        foreach ($serviceDetails as $serviceDetail) {
         $subtotalserv+= $serviceDetail->total_service;
                // dd($subtotalserv);
         }

         //Datos gastos repuestos
         $gastosDetails = $sale->saleExpenses;

   
        $pdf = PDF::loadView('admin.sale.boleta', compact('subtotal','saleDetails','sale','business','client','user','imagen_anulado', 'serviceDetails','subtotalserv','gastosDetails'));
        return $pdf->download('Boleta_de_venta_'.$client->name.'.pdf');
    }

    
    public function change_status(Sale $sale){
        
        if ($sale->status =='VALID') {
            $sale->update(['status'=>'CANCELED']);
            return redirect()->back();
        }

        else{
            $sale->update(['status'=>'VALID']);
            return redirect()->back();
        }
    }

    public function gasto(Sale $sale){
        
      //  dd($sale->id);
        //Obteniendo datos de Sale
        $sale = Sale::where('id', $sale->id)->first();
        $id = $sale->id;

        //Condicion si ya existe el id en la tabla gastos, regresar al menu
        $validacion_cliente_gastos = DB::table('expenses')->where('sale_id',$id)->first('sale_id');
        //dd($validacion_cliente_servicio);

        if($validacion_cliente_gastos != null){

            return redirect()->route('sales.index')->with('status2', 'Error');;
        }

        else{
          
             return view('admin.sale.create3', compact('sale'));
        }
    }

    
}

