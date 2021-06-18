<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $fillable = [
        'quantity', 'price', 'discount', 'gain', 'last_cost_price','sale_id' , 'product_id',
    ];

  
    public function product(){
        return $this->belongsTo(Product::class);

    }

}
