<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
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
