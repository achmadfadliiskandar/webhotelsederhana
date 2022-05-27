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
    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'nomortelpon' =>'required',
            'email' =>'required|email',
            'jumlah_penginap' => 'required|numeric',
            'rencanacheckin' => 'required',
            'rencanacheckout' => 'required',
            'lama_menginap' => 'required|numeric',
        ]);
        $booking = new GuestBooking;
        $booking->nama = $request->nama;
        $booking->email = $request->email;
        $booking->nomortelpon = $request->nomortelpon;
        $booking->kamar_id = $request->kamar_id;
        $booking->jumlah_penginap = $request->jumlah_penginap;
        $booking->rencanacheckin = $request->rencanacheckin;
        $booking->rencanacheckout = $request->rencanacheckout;
        $booking->totalharga = $booking->kamar->hargakamarpermalam * $request->lama_menginap - $request->dp_dibayar;
        $booking->lama_menginap = $request->lama_menginap;
        $booking->dp_dibayar = $request->dp_dibayar;
        // $order->kodebooking = mt_rand(100,5000);
        // untuk membuat pesan tanggal mulai dari sekarang atau hari besok
        if ($booking->rencanacheckin < (date("Y-m-d"))) {
            // dd("anda Tidak boleh");
            return redirect()->back()->with('fail','Tanggal Pesan Tidak Boleh Lebih dari Tanggal sebelumnya');
        }
        if ($booking->rencanacheckout < (date("Y-m-d"))) {
            // dd("anda Tidak boleh");
            return redirect()->back()->with('fail','Tanggal Pesan Tidak Boleh Kurang dari Tanggal Hari ini');
        }
        if ($booking->rencanacheckout == $booking->rencanacheckin) {
            return redirect()->back()->with('fail','Minimal Pemesanan 1 Hari');
        }
        if ($booking->rencanacheckout < $booking->rencanacheckin) {
            return redirect()->back()->with('fail','checkout dilarang kurang dari checkin');
        }
        // untuk membuat jumlah penginap pas dengan jumlah orang
        if ($request->jumlah_penginap > $booking->kamar->jumlahorangperkamar) {
            return redirect()->back()->with('fail','Jumlah Orang Tidak Boleh Lebih Dari Maksimal');
        } else {
            $booking->save();
            return redirect('guestorder')->with('status','Kamar Berhasil Di Pesan');
        }
    }
}
