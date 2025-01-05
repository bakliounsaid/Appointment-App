<?php

namespace App\Models;

use App\Traits\Search;
use Carbon\Carbon;
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
        'price'
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
        'price'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'appointment_status')
            ->withPivot('created_at')
            ->withTimestamps();
    }
    public function latestStatus()
    {
        return $this->hasOne(AppointmentStatus::class)->latestOfMany();
    }
    public function getFormattedClientDateAttribute()
    {

        return Carbon::parse($this->client_date)
            ->locale(app()->getLocale() === 'fr' ? 'fr' : 'ar')
            ->isoFormat('dddd, YYYY-MM-DD');
    }
    public function getFormattedAdminDateAttribute()
    {
        return Carbon::parse($this->admin_date)
            ->locale(app()->getLocale() === 'fr' ? 'fr' : 'ar')
            ->isoFormat('dddd, YYYY-MM-DD');
    }
    public function getFormattedAssemblyDateAttribute()
    {
        return Carbon::parse($this->assembly_date)
            ->locale(app()->getLocale() === 'fr' ? 'fr' : 'ar')
            ->isoFormat('dddd, YYYY-MM-DD');
    }
    protected function getNameAttribute()
    {
       return  $this->firstname . ' ' . $this->lastname;

    }
}
