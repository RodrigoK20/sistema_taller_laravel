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

        $comprasmes = DB::select('SELECT monthname(c.purchase_date) as mes, SUM(c.total) as totalmes FROM purchase c WHERE
        c.status = "VALID" GROUP BY monthname(c.purchase_date) ORDER BY month(c.purchase_date) desc limit 12');

        $ventasmes = DB::select('SELECT monthname(v.sale_date) as mes, SUM(v.total + v.total_service_dealer) as totalmes FROM sales v WHERE v.status = "VALID" GROUP BY monthname(v.sale_date) ORDER BY month(v.sale_date) desc limit 12');

        $ventasdia = DB::select('SELECT DATE_FORMAT(v.sale_date, "%d/%m/%Y") as dia, SUM(v.total + v.total_service_dealer) as totaldia FROM sales v
        WHERE v.status="VALID" GROUP BY v.sale_date ORDER BY day(v.sale_date) desc limit 15');

        $totales = DB::select('SELECT (SELECT ifnull(sum(c.total),0) FROM purchase c WHERE MONTH(c.purchase_date) = EXTRACT(MONTH FROM CURRENT_TIMESTAMP) AND c.status="VALID") as totalcompra, 
        (SELECT ifnull(sum(v.total + v.total_service_dealer),0) FROM sales v WHERE MONTH(v.sale_date)=EXTRACT(MONTH FROM CURRENT_TIMESTAMP) AND v.status="VALID") as totalventa');

        //Productos mas vendidos
        $productosvendidos = DB::select('SELECT p.code as code, SUM(dv.quantity) as quantity, p.name as name, p.id as id, p.stock as stock FROM products p
        INNER JOIN sale_details dv ON p.id = dv.product_id INNER JOIN sales v ON dv.sale_id = v.id WHERE v.status = "VALID" AND YEAR(v.sale_date)= YEAR(curdate()) 
        GROUP BY p.code, p.name, p.id, p.stock ORDER BY SUM(dv.quantity) DESC LIMIT 10');

        //Productos son stock cero y 5

        $productosstock = DB::select('SELECT p.code as code, p.stock as cantidad, p.name as name, p.id as id, p.stock as stock FROM products p
        order by p.stock DESC LIMIT 25;');



        return view('home', compact('comprasmes','ventasmes','ventasdia','totales','productosvendidos','productosstock','cantidadclientes','cantidadautos'));
    }
}
