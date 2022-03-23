<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarOrder extends Model
{
    use HasFactory;

    protected $table = 'kamar_orders';
    protected $guarded = ['id'];
}
