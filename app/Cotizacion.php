<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $fillable = [
        'date','total','client_id','car_id',
    ];


    //1 A N
       public function cotizacionDetails(){
        return $this->hasMany(CotizacionDetails::class);

    }

    //N A 1
       public function client(){
        return $this->belongsTo(Client::class);
    }

        //N A 1
        public function car(){
            return $this->belongsTo(Car::class);
        }
}
