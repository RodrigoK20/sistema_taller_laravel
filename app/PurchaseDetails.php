<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    protected $table="purchase_details";

    protected $fillable = [
        'quantity', 'price', 'comission' ,'purchase_id' ,'product_id',
    ];

       //Configuracion relaciones (ONE TO MANY INVERSE - SINGULAR (SEGUN RELACION TABLA))
       public function product(){
        return $this->belongsTo(Product::class);
    }

     public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
