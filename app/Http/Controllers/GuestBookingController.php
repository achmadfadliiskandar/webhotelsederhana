<?php

namespace App\Http\Controllers;

use App\Models\GuestBooking;
use Illuminate\Http\Request;


class GuestBookingController extends Controller
{
    public function index(){
        $guests = GuestBooking::all();
        return view('guest.index',compact('guests'));
    }
}
