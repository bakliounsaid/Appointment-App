<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'name',
        'class',
    ];
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_status')
                    ->using(AppointmentStatus::class)
                    ->withTimestamps();
    }
}
