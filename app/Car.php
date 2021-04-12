<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand', 'model', 'license_plate', 'year','picture','status' ,'viscosity','client_id',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

}
