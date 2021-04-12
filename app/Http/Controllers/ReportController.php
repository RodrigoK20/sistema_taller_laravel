<?php

namespace App\Http\Controllers;
use App\Sale;
use App\Business;

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

  
}
