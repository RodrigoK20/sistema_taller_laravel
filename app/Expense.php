<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    
    protected $fillable = [
        'name_product','price', 'quantity','date_registry','sale_id',
    ];

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
