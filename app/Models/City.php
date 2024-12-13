<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'ar_name',
        'fr_name',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
