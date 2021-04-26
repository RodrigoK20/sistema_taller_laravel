<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionDetails extends Model
{
    protected $fillable = [
        'product','quantity','price','car_id','cotizacion_id'
    ];


    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class);

    }
}
