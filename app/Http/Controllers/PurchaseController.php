<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Provider;
use App\Sale;
use App\Product;
use App\Business;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\PurchaseDetails;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Purchase\StoreRequest;
use App\Http\Requests\Purchase\UpdateRequest;

use Barryvdh\DomPDF\Facade as PDF;
use Dompdf;


class PurchaseController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:purchases.create')->only(['create','store']);
        $this->middleware('can:purchases.index')->only(['index']);
        $this->middleware('can:purchases.show')->only(['show']);

        $this->middleware('can:change.status.purchases')->only(['change_status']);
        $this->middleware('can:purchases.pdf')->only(['pdf']);
        $this->middleware('can:upload.purchases')->only(['upload']);
    }
    
    public function index()
    {
        
        $purchases = Purchase::get();
        return view('admin.purchase.index', compact('purchases'));

    }

 
    public function create()
    {   
        $providers = Provider::get();
        $products = Product::get();
        return view('admin.purchase.create', compact('providers','products'));
    }

  
    
  
    public function store(StoreRequest $request)
    {
        //dd($request);
        $purchase = Purchase::create($request->all()+[
            'user_id'=>Auth::user()->id,
            'purchase_date'=>Carbon::now('America/El_Salvador'),
        ]);

        //Detalle compra FORMA 1
 /*     $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;

        $count = 0;
        while($count < count($product_id)){
            $details = new PurchaseDetails();
            $details->purchase_id = $purchase->id;
            $details->product_id = $product_id[$count];
            $details->quantity = $quantity[$count];
            $details->price = $price[$count];
            $details->save();
            $count = $count+1;
        } */

        //Detalle compra FORMA 2
        foreach($request->product_id as $key =>$product){
            $results[] = array("product_id"=>$request->product_id[$key],
            "quantity"=>$request->quantity[$key],"price"=>$request->price[$key],"comission"=>$request->comission[$key]);

        }
                    //nombre relacion del modelo
        $purchase->purchaseDetails()->createMany($results);

        return redirect()->route('purchases.index');
    }

 
    public function show(Purchase $purchase)
    {

        //Acceder al detalle de la compras segun RELACION
        $purchaseDetails = $purchase->purchaseDetails;

        //Subtotal sin impuesto
        $subtotal = 0;
        
        //Sub
        foreach ($purchaseDetails as $purchaseDetail) {
                $subtotal+= $purchaseDetail->quantity * $purchaseDetail->price;
        }

        //dd($purchaseDetails);

        return view('admin.purchase.show', compact('purchase', 'purchaseDetails', 'subtotal'));
    }

    
 
    public function edit(Purchase $purchase)
    {
       // dd($purchase);
        $purchase = Purchase::where('id', $purchase->id)->first();

        if($purchase->picture == null){

            return view('admin.purchase.picture', compact('purchase'));
        }

        else{
            return redirect()->route('purchases.index')->with('status', 'Error');
        }

     
    }

    public function update(UpdateRequest $request, Purchase $purchase)
    {
       // $purchase->update($request->all());
        //return redirect()->route('categories.index');
    }

  
    public function destroy(Purchase $purchase)
    {
        //$purchase->delete();
        //return redirect()->route('categories.index');
    }

    //Comprobante de compra
    public function upload(Purchase $purchase, UpdateRequest $request){

        $id_purchase = $purchase->id;

       if($request->hasFile('picture')){
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image/purchases"),$image_name);
        }
     


      $data = DB::table('purchase AS purchase')
           ->where('purchase.id',$id_purchase)
           ->update(['purchase.picture' => $image_name]);

        
        return redirect()->route('purchases.index');
    }

     
    public function pdf(Purchase $purchase)
    {
        //Business data
        $business = Business::where('id',1)->firstOrFail();


        //Acceder al detalle de la compras segun RELACION
        $purchaseDetails = $purchase->purchaseDetails;

        //Subtotal sin impuesto
        $subtotal = 0;

        //Total comision compra
        $comision_total = 0;
        
        //Sub
        foreach ($purchaseDetails as $purchaseDetail) {
                $subtotal+= $purchaseDetail->quantity * $purchaseDetail->price;
        }

        //Comision
        foreach($purchaseDetails as $purchaseDetail){
            $comision_total+= $purchaseDetail->comission;
        }

        $pdf = PDF::loadView('admin.purchase.pdf', compact('subtotal','purchaseDetails','purchase','comision_total', 'business'));
        return $pdf->download('Reporte_de_compra'.$purchase->id.'.pdf');
    }

 
    public function change_status(Purchase $purchase){
                
        if ($purchase->status =='VALID') {
            $purchase->update(['status'=>'CANCELED']);
            return redirect()->back();
        }

        else{
            $purchase->update(['status'=>'VALID']);
            return redirect()->back();
        }

    }
}
