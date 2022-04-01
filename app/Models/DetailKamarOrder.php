<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKamarOrder extends Model
{
    use HasFactory;

    protected $table = 'detail_kamar_orders';

    protected $fillable = ['kamar_orders_id','bookings_id'];

    public function bookings(){
        return $this->belongsTo(Booking::class);
    }
    public function kamarorder(){
        return $this->belongsTo(KamarOrder::class);
    }
}
