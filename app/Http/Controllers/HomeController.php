<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cantidadclientes = DB::select('SELECT COUNT(*) AS numclientes FROM clients c ');

        $cantidadautos= DB::select('SELECT COUNT(*) AS numautos FROM cars c ');

        $comprasmes = DB::select('SELECT monthname(c.purchase_date) as mes, SUM(c.total) as totalmes FROM purchase c
        WHERE MONTH(c.purchase_date)=EXTRACT(MONTH FROM c.purchase_date) AND YEAR(c.purchase_date) = YEAR(CURRENT_DATE()) AND  c.status = "VALID" GROUP BY monthname(c.purchase_date) ORDER BY month(c.purchase_date) ASC limit 12;');

        $ventasmes = DB::select('SELECT monthname(v.sale_date) as mes, SUM(v.total + v.total_service_dealer) as totalmes FROM sales v WHERE MONTH(v.sale_date)=EXTRACT(MONTH FROM v.sale_date) AND YEAR(v.sale_date) = YEAR(CURRENT_DATE()) AND v.status = "VALID" GROUP BY monthname(v.sale_date) ORDER BY month(v.sale_date) asc limit 12;');

        $ventasdia = DB::select('SELECT DATE_FORMAT(v.sale_date, "%d/%m/%Y") as dia, SUM(v.total + v.total_service_dealer) as totaldia FROM sales v
        WHERE v.status="VALID" AND  v.sale_date>= DATE_ADD(CURDATE(), INTERVAL -10 DAY) GROUP BY v.sale_date ORDER BY day(v.sale_date) DESC LIMIT 10');

        $totales = DB::select('SELECT (SELECT ifnull(sum(c.total),0) FROM purchase c WHERE MONTH(c.purchase_date) = EXTRACT(MONTH FROM CURRENT_TIMESTAMP) AND YEAR(c.purchase_date) = YEAR(CURRENT_DATE())  AND c.status="VALID") as totalcompra, 
        (SELECT ifnull(sum(sd.gain),0) FROM sale_details sd JOIN sales s ON s.id = sd.sale_id WHERE MONTH(s.sale_date)=EXTRACT(MONTH FROM CURRENT_TIMESTAMP) AND YEAR(s.sale_date) = YEAR(CURRENT_DATE()) AND s.status="VALID") as totalgananciaprod;');

        $tallertotales = DB::select("SELECT (SELECT SUM(v.total + v.total_service_dealer) FROM sales v WHERE MONTH(CURRENT_DATE())=EXTRACT(MONTH FROM v.sale_date) AND YEAR(v.sale_date) = YEAR(CURRENT_DATE()) AND  v.status='VALID') as totalservicios, 
        (SELECT ifnull(sum(ex.mount),0) FROM expense_shops ex WHERE MONTH(ex.date_registry) = EXTRACT(MONTH FROM CURRENT_TIMESTAMP) AND YEAR(ex.date_registry) = YEAR(CURRENT_DATE()))  as gastos_taller;");

        $totalrepuestosxdia = DB::select("SELECT SUM(e.price * e.quantity) as totalr FROM expenses e WHERE e.date_registry = CURRENT_DATE()");

        //Productos mas vendidos
        $productosvendidos = DB::select('SELECT p.code as code, SUM(dv.quantity) as quantity, p.name as name, p.id as id, p.stock as stock FROM products p
        INNER JOIN sale_details dv ON p.id = dv.product_id INNER JOIN sales v ON dv.sale_id = v.id WHERE v.status = "VALID" AND YEAR(v.sale_date)= YEAR(curdate()) 
        GROUP BY p.code, p.name, p.id, p.stock ORDER BY SUM(dv.quantity) DESC LIMIT 10');

        //Productos son stock cero y 5

        $productosstock = DB::select('SELECT p.code as code, p.stock as cantidad, p.name as name, p.id as id, p.stock as stock FROM products p
        order by p.stock DESC LIMIT 35;');



        return view('home', compact('comprasmes','ventasmes','ventasdia','totales','productosvendidos','productosstock','cantidadclientes','cantidadautos','tallertotales','totalrepuestosxdia'));
    }
}
