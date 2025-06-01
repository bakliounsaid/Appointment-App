<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, Search, SoftDeletes;

    protected $searchable_attributes = [
        'name_ar',
        'name_fr',
    ];

    protected $fillable = [
        'name_fr',
        'name_ar',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
