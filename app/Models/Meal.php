<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_details')->withPivot('amount_to_pay');
    }

  


}