<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
       public function orderable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
