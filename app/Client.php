<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'dui', 'address', 'phone', 'email',
    ];

    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

      //Config relaciones (ONE TO MANY - Plural)
      public function cars(){
        return $this->hasMany(Car::class);
    }

 
}
