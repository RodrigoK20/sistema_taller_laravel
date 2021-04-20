<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseShop extends Model
{
    protected $fillable = [
        'tag','mount', 'date_registry','date_paid','status',
    ];

    use SoftDeletes;

    //Soft delete
    protected $dates = ['deleted_at'];
}
