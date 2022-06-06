<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBooking extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = ['guest_bookings_id','kata'];
    public function kamar(){
        return $this->belongsTo(Kamar::class);
    }
    public function guestpdf(){
        return $this->hasMany(GuestCetakPdf::class);
    }
}
