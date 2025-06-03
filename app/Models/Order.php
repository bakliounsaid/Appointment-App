<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Search;
    const STOP_DESK = 1;
    const DOMICILE = 0;

    protected static $recordEvents = ['created', 'deleted'];
    protected $fillable = [
        'fullname',
        "client_phone",
        "client_address",
        "client_email",
        'delivery_fees',
        'delivery_method',
        'delivery_fees',
        'tracking_code',
        'city_id',
        'delivery_service'
    ];
    protected $searchable_attributes = [
        "fullname",
        "client_phone"
    ];

    public function getDeliveryTypeAttribute()
    {
        return  $this->delivery_method ? __('Stopdesk') :  __('Domicile');
    }

    public function getTotalNoDeliveryAttribute()
    {
        return $this->orderProduct->sum(fn($orderProduct) =>  $orderProduct->orderable->category->name_fr == 'La Rail' ? $this->totalLargeur * $orderProduct->sell_price : $orderProduct->quantity * $orderProduct->sell_price);
    }

    public function getTotalAttribute()
    {
        return $this->orderProduct->sum(fn($orderProduct) =>  $orderProduct->orderable->category->name_fr == 'La Rail' ? $this->totalLargeur * $orderProduct->sell_price  : $orderProduct->quantity * $orderProduct->sell_price)
            + ((isset($this->delivery_fees)) ? intval($this->delivery_fees) : intval(0));
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get all of the products that are assigned this order.
     */
    public function products()
    {
        return $this->morphedByMany(Product::class, 'orderable', 'product_orders')->withPivot(['quantity'])->withTimestamps();;
    }


    public function orderProduct()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function orderStatus()
    {
        return $this->hasMany(OrderStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(OrderStatus::class)->latestOfMany();
    }
    public function dimension()
{
        return $this->hasMany(Dimension::class);

    }
    public function totalLargeur(): Attribute
    {
        return Attribute::get(function () {
                return $this->dimension->sum('largeur');
        });
    }
}
