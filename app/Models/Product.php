<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Search ,SoftDeletes;

    protected $fillable = [
    'name_ar',
    'name_fr',
    'description_ar',
    'description_fr',
    'available',
    'price',
];
  protected $searchable_attributes = [
    'name_ar',
    'name_fr',
    'description_ar',
    'description_fr',
    ];

     public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

     public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable');
    }

     public function orderProducts()
    {
        return $this->morphMany(ProductOrder::class, 'orderable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
