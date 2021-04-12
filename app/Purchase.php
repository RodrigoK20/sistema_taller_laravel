<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table="purchase";

    protected $fillable = [
        'purchase_date', 'tax', 'total', 'status' ,'picture','comission_total' ,'user_id', 'provider_id',
    ];

    //Configuracion relaciones (ONE TO MANY INVERSE - SINGULAR (SEGUN RELACION TABLA))
    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function user(){
        return $this->belongsTo(User::class);

    }

    //1 A N
    public function purchaseDetails(){
        return $this->hasMany(PurchaseDetails::class);

    }
}
