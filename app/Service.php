<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_date','total_service', 'sale_id', 'workshop_id' ,'client_id','user_id',
    ];


    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function workshop(){
        return $this->belongsTo(Workshop::class);

    }

    public function client(){
        return $this->belongsTo(Client::class);

    }

    public function car(){
        return $this->belongsTo(Car::class);

    }


}
