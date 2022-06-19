<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['order'];
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function setFromTimeAttribute($value)
    {
        $this->attributes['from_time'] = Carbon::parse($value)->timestamp;
    }

    public function setToTimeAttribute($value)
    {
        $this->attributes['to_time'] = Carbon::parse($value)->timestamp;
    }
}
