<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCetakPdf extends Model
{
    use HasFactory;
    protected $fillable = ['guest_bookings_id','kodebooking','kodeupdate'];

    public function guest(){
        return $this->belongsTo(GuestBooking::class,'guest_bookings_id');
    }
}
