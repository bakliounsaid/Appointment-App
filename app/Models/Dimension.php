<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dimension extends Model
{
    use HasFactory;
    protected $table = 'dimensions';
    
    protected $fillable = [
        'order_id',
        'room_number',
        'largeur',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
