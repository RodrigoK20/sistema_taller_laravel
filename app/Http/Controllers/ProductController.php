<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Provider;
use App\Purchase;
use App\PurchaseDetails;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Barryvdh\DomPDF\Facade as PDF;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:products.create')->only(['create','store']);
        $this->middleware('can:products.index')->only(['index']);
        $this->middleware('can:products.edit')->only(['edit','update']);
        $this->middleware('can:products.show')->only(['show']);
        $this->middleware('can:products.destroy')->only(['destroy']);

        $this->middleware('can:change.status.products')->only(['change_status']);
        

    }
 
    public function index()
    {
        //Listado de Productos
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        $providers = Provider::get();
        $units = Unit::get();
        return view('admin.product.create', compact('categories','providers','units'));
    }

  
    public function store(StoreRequest $request)
    {
        //Hay imagen pero no codigo
        if ($request->picture!=null && $request->code=="") {
            $file = $request->file('picture');
             $image_name = time().'_'.$file->getClientOriginalName();
             $file->move(public_path("/image/products"),$image_name);

             $product = Product::create($request->all()+[
                'image'=> $image_name,
            ]);

            $numero = $product->id;
            $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
            $product->update(['code'=>$numeroConCeros]);

          }
          //hay imagen y  codigo
          elseif ($request->picture!=null && $request->code != "") {
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image/products"),$image_name);

            $product = Product::create($request->all()+[
                'image'=> $image_name,
            ]);

          }

        //hay codigo y no imagen
          elseif ($request->picture==null && $request->code != "") {
            $product = Product::create($request->all());

          }
     
          //No hay codigo y no hay imagen
          else {

            $product = Product::create($request->all());
            $product->update(['picture'=>"NULL"]);
            $numero = $product->id;
            $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
            $product->update(['code'=>$numeroConCeros]);

          }
    
        return redirect()->route('products.index');
    }
   
    public function show(Product $product)
    {
        //Detalle producto
        return view('admin.product.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        $categories = Category::get();
        $providers = Provider::get();
        $units = Unit::get();

        return view('admin.product.edit', compact('product', 'categories','providers','units'));
    }


    public function update(UpdateRequest $request, Product $product)
    {
           //Hay imagen pero no codigo
           if ($request->picture!=null && $request->code=="") {
            $file = $request->file('picture');
             $image_name = time().'_'.$file->getClientOriginalName();
             $file->move(public_path("/image/products"),$image_name);

             $product->update($request->all()+[
                'image'=> $image_name,
            ]);

            $numero = $product->id;
            $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
            $product->update(['code'=>$numeroConCeros]);

          }
          //hay imagen y  codigo
          elseif ($request->picture!=null && $request->code != "") {
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image/products"),$image_name);

            $product->update($request->all()+[
                'image'=> $image_name,
            ]);

          }

        //hay codigo y no imagen
          elseif ($request->picture==null && $request->code != "") {
            $product->update($request->all());

          }
     
          //No hay codigo y no hay imagen
          else {

            $product->update($request->all());
            $product->update(['picture'=>"NULL"]);
            $numero = $product->id;
            $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
            $product->update(['code'=>$numeroConCeros]);

          }
    
        return redirect()->route('products.index');

    }

  
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function change_status(Product $product){
        
        if ($product->status =='ACTIVE') {
            $product->update(['status'=>'DEACTIVATED']);
            return redirect()->back();
        }

        else{
            $product->update(['status'=>'ACTIVE']);
            return redirect()->back();
        }

    }
    
    public function get_products_by_barcode(Request $request){

        if($request->ajax()){
            $products = Product::where('code', $request->code)->firstOrFail();
            $result = DB::select('SELECT pd.price FROM purchase_details pd JOIN purchase p ON p.id = pd.purchase_id WHERE pd.product_id = :product_id ORDER BY p.purchase_date DESC LIMIT 1' , ['product_id'=>$request->product_id]);
            return response()->json(['products'=>$products, 'result'=>$result]);
        }
     
        
    }
    public function get_products_by_id(Request $request){
        if ($request->ajax()) {
            $products = Product::findOrFail($request->product_id);
            $result = DB::select('SELECT pd.price FROM purchase_details pd JOIN purchase p ON p.id = pd.purchase_id WHERE pd.product_id = :product_id ORDER BY p.purchase_date DESC LIMIT 1' , ['product_id'=>$request->product_id]);
            
            return response()->json(['products'=>$products, 'result'=>$result]);
        }

       
    }

    //Mostrar codigos prod pdf
    public function get_bar_code()
    {
        //Listado de Productos
        $products = Product::get();
    
        $pdf = PDF::loadView('admin.product.barcode', compact('products'));
        return $pdf->download('Code_products'.'.pdf');
    }

}
