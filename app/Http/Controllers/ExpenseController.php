<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
  
    public function index()
    {
        //
    }

 
    public function create(Request $request)
    {
        //return view('admin.sale.create3');
    }


    public function store(Request $request)
    {

        //dd($request->name_product);
         //Obteniendo valores
         $id_sale = $request->sale_id;
     
          $count = 0;
          while($count < count($id_sale)){
              $details = new Expense();
              $details->sale_id = $id_sale[$count];
              $details->name_product = $request->name_product[$count];
              $details->price = $request->price[$count];
              $details->quantity = $request->quantity[$count];
              $details->date_registry = $request->date_registry;
              $details->save();
              $count = $count+1;
          } 
  
         $time_update = Carbon::now('America/El_Salvador');
         $total_gastos= $request->total;

         //Actualizando campo total_expense de la tabla Sale

         $data = DB::table('sales AS sale')
           ->where('sale.id',$id_sale)
           ->update(['sale.total_expense' => $total_gastos]);

  
         return redirect()->route('sales.index');
    }


    public function show(Expense $expense)
    {
        //
    }

 
    public function edit(Expense $expense)
    {
        //
    }

 
    public function update(Request $request, Expense $expense)
    {
        //
    }

 
    public function destroy(Expense $expense)
    {
        //
    }
}
