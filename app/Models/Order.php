<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use phpDocumentor\Reflection\Types\This;
use PhpParser\Node\Expr\FuncCall;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['meals'];
    // protected $appends = ['count'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class,'order_details')

        ->withPivot('amount_to_pay')->withTimestamps();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


}
