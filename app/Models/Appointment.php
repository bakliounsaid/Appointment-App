<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory, Search;
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'localisation',
        'address',
        'city_id',
        'client_date',
        'admin_date',
    ];
    protected $searchable_attributes = [
      'firstname',
        'lastname',
        'phone',
        'email',
        'localisation',
        'address',
        'city_id',
        'client_date',
        'admin_date',
        'description',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'appointment_status')
                    ->withTimestamps();
    }
}
