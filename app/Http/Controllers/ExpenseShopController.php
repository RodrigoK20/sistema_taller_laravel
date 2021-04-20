<?php

namespace App\Http\Controllers;

use App\ExpenseShop;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseShop\StoreRequest;
use Illuminate\Support\Facades\DB;

class ExpenseShopController extends Controller
{
    
    public function index()
    {
        $expenseshop = ExpenseShop::orderBy('date_registry', 'DESC')->get();
        return view('admin.eshop.index',compact('expenseshop'));
    }

   
    public function create()
    {
       
    }


    public function store(StoreRequest $request)
    {
        
        ExpenseShop::create($request->validated());

        return redirect()->route('expenseshop.index');
    }


    public function show(ExpenseShop $expenseShop)
    {
        //
    }

  
    public function edit(ExpenseShop $expenseshop, Request $request)
    {
        //Obteniendo datos de Sale
        $gasto = ExpenseShop::where('id', $expenseshop->id)->first();
        $id_gasto = $gasto->id;

       // dd($id_gasto);

        //Condicion si ya existe el id en la tabla gastos, regresar al menu verificar si esta nulo
        $validacion_gastos = DB::select('SELECT e.id,e.date_paid FROM expense_shops e WHERE e.date_paid IS NULL  AND e.id= :id_gasto',['id_gasto'=>$id_gasto]);

        //dd($validacion_gastos);
        
        if($validacion_gastos != null){

            return view('admin.eshop.edit', compact('expenseshop'));

            
        }

        else{
            return redirect()->route('expenseshop.index')->with('status', 'Error');
        
        }

      

    
    }


    public function update(Request $request, ExpenseShop $expenseshop)
    {
       // dd($request->date_paid);

        
   
        if ($expenseshop->status =='UNPAID') {
            $expenseshop->update(['status'=>'PAID']);
            $expenseshop->update(['date_paid'=>$request->date_paid]);

            return redirect()->route('expenseshop.index');
        }

      

    }

 
    public function destroy(ExpenseShop $expenseshop)
    {
        $expenseshop->delete();
        $data = ExpenseShop::onlyTrashed()->get();
        //dd($data);

        $success = true;
        $message = "Gasto eliminado";

        return redirect()->route('expenseshop.index', compact('data'))->with('success',$success);
    }
}
