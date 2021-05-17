<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Provider;
use App\Purchase;
use App\PurchaseDetails;
use App\Unit;
use App\Business;

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

        $cantidad_productos_sin_stock = DB::select('SELECT COUNT(*) as stock FROM products p WHERE p.status="ACTIVE" AND p.stock=0');

        $cantidad_productos = DB::select('SELECT SUM(p.stock) as cantidad FROM products p WHERE p.status="ACTIVE"');

        $categories = Category::get();

        return view('admin.product.index', compact('products','cantidad_productos_sin_stock','cantidad_productos','categories'));
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

        $query = DB::select('SELECT pd.price as costo FROM purchase p JOIN purchase_details pd ON pd.purchase_id = p.id JOIN products pr ON pd.product_id = pr.id WHERE pr.id = :id ORDER BY p.purchase_date DESC LIMIT 1', ['id'=>$product->id]);

        return view('admin.product.show', compact('product', 'query'));
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

    //Reporte pdf

    public function report_products(Request $request){

      //dd($request->category_id);

      if($request->btn_consultar==1){

        //Reporte por categoria productos

        $fecha_hora = Carbon::now('America/El_Salvador');

        //Datos Empresa
        $business = Business::where('id',1)->firstOrFail();

        $query_products  = DB::select('SELECT p.id,p.name as nombre, p.stock as stock, p.sell_price as precio, u.name as unidad, c.name as categoria, pr.name as proveedor FROM products p JOIN categories c ON c.id = p.category_id 
        JOIN units u ON u.id = p.unit_id JOIN providers pr ON pr.id = p.provider_id WHERE c.id= :category_id GROUP BY p.id ORDER BY p.stock ASC',['category_id'=>$request->category_id]);

        $nombre_cat ="";

        foreach ($query_products as $query) 
        {
          $nombre_cat = $query->categoria;
        }
    
        $cantidad_productos = DB::select('SELECT COUNT(*) as cantidad FROM products p JOIN categories c ON c.id= p.category_id  WHERE p.status="ACTIVE" AND c.id=:category_id',['category_id'=>$request->category_id]);

        $pdf = PDF::loadView('admin.product.category_report', compact('business','query_products','cantidad_productos','fecha_hora','nombre_cat'))->setPaper('a3', 'portrait');
        return $pdf->download('Reporte_inventario_categoria'.'.pdf');

        }

        else{
            //GENERAR PDF TODOS LOS PRODUCTOS EN INVENTARIO

            $fecha_hora = Carbon::now('America/El_Salvador');

            //Datos Empresa
            $business = Business::where('id',1)->firstOrFail();

            $query_products  = DB::select('SELECT p.id,p.name as nombre, p.stock as stock, p.sell_price as precio, u.name as unidad, c.name as categoria, pr.name as proveedor, pd.price as costo from products p JOIN categories c ON c.id = p.category_id
            JOIN units u ON u.id = p.unit_id JOIN providers pr ON pr.id = p.provider_id JOIN purchase_details pd ON pd.product_id = p.id JOIN purchase pur ON pur.id = pd.purchase_id GROUP BY p.id ORDER BY p.stock ASC');
        
            $cantidad_productos = DB::select('SELECT COUNT(*) as cantidad FROM products p WHERE p.status="ACTIVE"');

            $pdf = PDF::loadView('admin.product.pdf', compact('business','query_products','cantidad_productos','fecha_hora'))->setPaper('a3', 'portrait');
            return $pdf->download('Reporte_inventario'.'.pdf');
        }
    }

}
