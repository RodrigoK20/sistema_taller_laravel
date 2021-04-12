<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 'name', 'stock', 'description' ,'image', 'sell_price', 'status', 'category_id', 'unit_id', 'provider_id',
    ];

    
    //Configuracion relaciones (ONE TO MANY INVERSE - SINGULAR (SEGUN RELACION TABLA))
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
