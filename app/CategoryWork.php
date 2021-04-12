<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryWork extends Model
{
    
    protected $fillable = [
        'name', 'description'
    ];

    use SoftDeletes;

    //Soft delete
    protected $dates = ['deleted_at'];

    //Config relaciones (ONE TO MANY - Plural)
    public function workshops(){
        return $this->hasMany(Workshop::class);
    }
}
