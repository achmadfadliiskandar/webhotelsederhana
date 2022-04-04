<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $fasilitas = ['nokamar','tipe_kamars_id','jumlahorangperkamar','status','hargapermalam','image'];

    public function tipe_kamar(){
        return $this->belongsTo(TipeKamar::class,'tipe_kamars_id');
    }
    public function fasilitas(){
        return $this->belongsToMany(Fasilitas::class)->withTimestamps();
    }
    public function detailkamar(){
        return $this->hasMany(FasilitasKamar::class,'kamar_id');
    }
    public function detailkamarorder(){
        return $this->hasMany(DetailKamarOrder::class);
    }
    public function bookings(){
        return $this->hasOne(Booking::class);
    }
    public function kamarorder(){
        return $this->hasOne(KamarOrder::class);
    }
}
