<?php

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CategoryWorkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect()->route('login');
});

//RUTAS DE LOS CONTROLADORES
                //Se puede cambiar ej admin/cat         //Nombre ruta
Route::resource('categories', 'CategoryController')->names('categories');
Route::resource('units', 'UnitController')->names('units');
Route::resource('clients', 'ClientController')->names('clients');
Route::resource('cars', 'CarController')->names('cars');
Route::resource('categorywork','CategoryWorkController')->names('categorieswork');
Route::resource('workshop','WorkshopController')->names('workshops');
Route::resource('products', 'ProductController')->names('products');
Route::resource('providers', 'ProviderController')->names('providers');
Route::resource('cotizacions', 'CotizacionController')->names('cotizacions');
Route::resource('purchases', 'PurchaseController')->names('purchases')->except([
    'update', ''
]);




//Reportes 
//GET-> Pantalla inicial
Route::get('report/reports_day', 'ReportController@reports_day')->name('reports.day');
Route::get('report/reports_date', 'ReportController@reports_date')->name('reports.date');
Route::get('report/reports_expense', 'ReportController@report_expense')->name('report.expense');

Route::post('report/report_results','ReportController@report_results')->name('report.results');
Route::post('report/report_results_history','ReportController@report_results_history')->name('report.resultshistory');
Route::post('report/report_results_expense','ReportController@report_results_expense')->name('report.result2');
Route::post('report/report_resultspurchase', 'ReportController@report_purchases')->name('report.purchases');

Route::post('report/report_products','ProductController@report_products')->name('report.products');


//////////////////////

Route::resource('sales', 'SaleController')->names('sales')->except([
    '',
]);

Route::resource('expenseshops', 'ExpenseShopController')->names('expenseshop')->except([
    '',
]);

//Ruta gastos venta
Route::get('sales/gastoventa/{sale}','SaleController@gasto')->name('sales.gasto');

//Ruta gastos ventas
Route::get('sales/gasto','SaleController@guardargasto')->name('sales.guardargasto');

//Ruta gastos venta
Route::resource('expenses', 'ExpenseController')->names('expenses')->except([
    '',
]);



Route::resource('services', 'ServiceController')->names('services')->except([
    '',
]);



//Ruta boleta
Route::get('sales/boleta/{sale}','SaleController@pdf_boleta')->name('sales.boleta');
Route::get('cotizacions/boleta/{cot}','CotizacionController@pdf_cotizacion')->name('cotizacions.boleta');

Auth::routes();

Route::resource('business','BusinessController')->names('business')->only([
    'index', 'update'
]);

                                                        //funcion del controlador
Route::get('purchases/pdf/{purchase}','PurchaseController@pdf')->name('purchases.pdf');

Route::get('sales/pdf/{sale}','SaleController@pdf')->name('sales.pdf');

Route::get('cars/pdf/{car}','CarController@pdf')->name('cars.pdf');

//Agregar imagen compra
Route::post('purchases/{purchase}','PurchaseController@upload')->name('purchases.upload');

//Cambiar estado
Route::get('change_status/products/{product}', 'ProductController@change_status')->name('change.status.products');
Route::get('change_status/purchases/{purchase}', 'PurchaseController@change_status')->name('change.status.purchases');
Route::get('change_status/sales/{sale}', 'SaleController@change_status')->name('change.status.sales');
Route::get('change_status/workshop/{workshop}', 'WorkshopController@change_status')->name('change.status.workshops');
Route::get('change_status/cars/{car}', 'CarController@change_status')->name('change.status.cars');



//Users
Route::resource('users','UserController')->names('users');

//Roles
Route::resource('roles','RoleController')->names('roles');

//Product code
Route::get('get_products_by_barcode', 'ProductController@get_products_by_barcode')->name('get_products_by_barcode');
Route::get('get_products_by_id', 'ProductController@get_products_by_id')->name('get_products_by_id');
Route::get('get_products_by_id_ganancia', 'ProductController@get_products_by_id_ganancia')->name('get_products_by_id_ganancia');

//Cars
Route::get('get_cars_by_id', 'ClientController@get_cars_by_id')->name('get_cars_by_id');

//Cotizacion services
Route::get('get_services_by_id', 'CotizacionController@get_services_by_id')->name('get_services_by_id');
Route::get('get_service_data_by_id', 'CotizacionController@get_service_data_by_id')->name('get_service_data_by_id');

Route::get('print_barcode', 'ProductController@get_bar_code')->name('print_barcode');

//Workshop code
Route::get('get_workshops_by_id', 'WorkShopController@get_workshops_by_id')->name('get_workshops_by_id');

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

//Logout
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');