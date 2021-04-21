<?php

namespace App\Http\Controllers;
use App\Sale;
use App\Business;
use App\ExpenseShop;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:reports.day')->only(['reports_day']);
        $this->middleware('can:reports.date')->only(['reports_date']);
    }
    
    public function reports_day(){

        $sales = Sale::WhereDate('sale_date', Carbon::today('America/El_Salvador'))->where('status','=','VALID')->get();
        $total = $sales->sum('total');
        $totaltaller = $sales->sum('total_service_dealer');
        return view('admin.report.reports_day', compact('sales', 'total', 'totaltaller'));

    }

    public function reports_date(){
        $sales = Sale::WhereDate('sale_date', Carbon::today('America/El_Salvador'))->where('status','=','VALID')->get();
        $total = $sales->sum('total');
        $totaltaller = $sales->sum('total_service_dealer');

        return view('admin.report.reports_date', compact('sales', 'total','totaltaller'));
    }

    public function report_expense(){

        $expense = ExpenseShop::Where('status','=','PAID')->get();
        $total = $expense->sum('mount');
        $cantidad = DB::select('SELECT COUNT(*) as cantidad_gastos FROM expense_shops e WHERE e.status="PAID"');


        return view('admin.report.reportexpense',compact('expense','total','cantidad'));
    }

    public function report_results(Request $request){

        if($request->btn_consultar==1){

       
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $sales = Sale::whereBetween('sale_date', [$fi, $ff])->where('status','=','VALID')->get();
        $total = $sales->sum('total');
        $totaltaller = $sales->sum('total_service_dealer');
        return view('admin.report.reports_date', compact('sales', 'total','totaltaller')); 

        }

        else{
            //GENERAR PDF REPORTE HISTORICO 

            $fi = $request->fecha_ini. ' 00:00:00';
            $ff = $request->fecha_fin. ' 23:59:59';

            //Datos Empresa
            $business = Business::where('id',1)->firstOrFail();

            $query_products  = DB::select('SELECT s.id as sale_id,s.sale_date as fecha_venta,s.total as total, s.tax as tax, sl.quantity, sl.price, sl.discount, sl.gain, p.name as producto, p.sell_price, cl.name as cliente FROM sales s JOIN sale_details sl ON sl.sale_id = s.id JOIN products p ON p.id = sl.product_id
            JOIN clients cl ON cl.id = s.client_id WHERE s.status= "VALID" AND s.sale_date BETWEEN :fi AND :ff ', ['fi'=>$fi, 'ff'=>$ff]);

            //Total ganancia
            $total_ganancia = 0;

            //Total venta productos
            $total = 0;

            foreach ($query_products as $saleDetail) {
                $total_ganancia += $saleDetail->gain;
                $total +=  $saleDetail->total;
            }

            //Cantidad productos vendidos
            $cantidad_venta = DB::select('SELECT SUM(sl.quantity) as cantidadventa FROM sale_details sl JOIN sales s ON s.id= sl.sale_id WHERE s.status="VALID" AND s.sale_date BETWEEN :fi AND :ff ', ['fi'=>$fi, 'ff'=>$ff]);
            
          
            $query_services = DB::select('SELECT sa.id as id,s.total_service, s.service_date, cl.name as cliente, CONCAT(c.brand, " " , c.model) as car, c.license_plate, ws.name_service as servicio  from services s JOIN sales sa ON s.sale_id = sa.id
            JOIN clients cl ON cl.id = s.client_id JOIN cars c ON c.id = s.car_id JOIN workshops ws ON ws.id = s.workshop_id WHERE sa.status = "VALID" AND s.service_date BETWEEN :fi AND :ff
            ORDER BY sa.id ASC', ['fi'=>$fi, 'ff'=>$ff]);

            $total_services = 0;
        
            foreach ($query_services as $services) {
                $total_services += $services->total_service;
               
            }

            $cantidad_services = DB::select('SELECT COUNT(*) as cantidad_servicios FROM services sv JOIN sales s ON s.id = sv.sale_id WHERE s.status = "VALID" AND sv.service_date BETWEEN :fi AND :ff',['fi'=>$fi, 'ff'=>$ff]);

          
            $pdf = PDF::loadView('admin.report.reports_date_history', compact('business','fi','ff','query_products','total_ganancia','total','cantidad_venta', 'query_services','total_services', 'cantidad_services'))->setPaper('a3', 'portrait');
            return $pdf->download('Reporte_historico'.$fi.'.pdf');
        }

    }

    public function report_results_expense(Request $request){

       // dd($request->fecha_ini);

        if($request->btn_consultar==1){

       
        $fi = $request->fecha_ini;
        $ff = $request->fecha_fin;
        $expense = ExpenseShop::whereBetween('date_paid', [$fi, $ff])->where('status','=','PAID')->get();
        $total = $expense->sum('mount');

        $cantidad = DB::select('SELECT COUNT(*) as cantidad_gastos FROM expense_shops e WHERE  e.date_paid BETWEEN :fi AND :ff AND e.status="PAID" ' , ['fi'=>$fi, 'ff'=>$ff]);

        return view('admin.report.reportexpense', compact('expense', 'total','cantidad')); 

        }

        else{
            //GENERAR PDF REPORTE HISTORICO 

        }

    }

    public function report_purchases(Request $request){

            $fi = $request->fecha_ini. ' 00:00:00';
            $ff = $request->fecha_fin. ' 23:59:59';

            //Datos Empresa
            $business = Business::where('id',1)->firstOrFail();

            $query_purchases  = DB::select('SELECT p.purchase_date, p.total as total, p.status, pd.comission as comission, pd.price as price_purchase, pd.quantity as quantity, pro.name as product, pro.sell_price, prov.name as proveedor FROM purchase p INNER JOIN purchase_details pd ON p.id = pd.purchase_id 
            INNER JOIN products pro ON pro.id = pd.product_id INNER JOIN providers prov ON prov.id = p.provider_id
            WHERE p.status= "VALID" AND p.purchase_date BETWEEN :fi AND :ff ', ['fi'=>$fi, 'ff'=>$ff]);

            //Total comision generada
            $total_comision = 0;

    
            foreach ($query_purchases as $purchases) {
                $total_comision += $purchases->comission;
            }


            //Numero de compras realizadas
            $cantidad_compras = DB::select('SELECT COUNT(*) as cantidadcompras FROM purchase p WHERE p.status="VALID" AND p.purchase_date BETWEEN :fi AND :ff ', ['fi'=>$fi, 'ff'=>$ff]);
            
            //Total compras

            $total_compras= 0;

            foreach ($query_purchases as $purchases) {
                $total_compras += $purchases->total;
            }
           
        
            $pdf = PDF::loadView('admin.report.reports_purchases', compact('business','fi','ff','query_purchases','total_comision','cantidad_compras','total_compras'))->setPaper('a3', 'portrait');
            return $pdf->download('Reporte_compras_'.$fi.'.pdf');


    }

  
}
