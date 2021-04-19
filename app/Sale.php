<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'sale_date', 'tax', 'total', 'status' ,'total_service_dealer','total_expense' ,'user_id', 'client_id',
    ];

     //Configuracion relaciones (ONE TO MANY INVERSE - SINGULAR (SEGUN RELACION TABLA))
     public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);

    }

    //1 A N
    public function saleDetails(){
        return $this->hasMany(SaleDetails::class);

    }

       //1 A N
    public function saleServices(){
        return $this->hasMany(Service::class);

    }

    public function saleExpenses(){
        return $this->hasMany(Expense::class);
    }
}
