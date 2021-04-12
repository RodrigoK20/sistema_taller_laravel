<?php

namespace App;

use App\CategoryWork;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = [
        'name_service', 'description','cost','status','category_work_id',
    ];


    public function categorywork(){
                                                    //LLAVE FORANEA
        return $this->belongsTo(CategoryWork::class, 'category_work_id');
    }
}
