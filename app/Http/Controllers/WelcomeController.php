<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Fasilitas;
use App\Services\LogActivitiesServices\MainLogActivitiesServices;
use Illuminate\Http\Request;
use App\Models\FasilitasUmum;
use App\Models\Kamar;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function __construct(MainLogActivitiesServices $log) {
        $this->logging = $log;
    }
    public function welcome(){
        $this->logging->activitylog(true,'halaman welcome');
        $fasilitasumums = FasilitasUmum::all();
        $kamars = Kamar::all();
        return view('welcome',compact('fasilitasumums','kamars'));
    }
    public function loginadmin(){
        return view('admin.login');
    }
    public function loginresepsionis(){
        return view('resepsionis.login');
    }
    public function detailroom($id){
        $kamars = Kamar::with('detailkamar')->where('id',$id)->first();
        $fasilitass = Fasilitas::all();
        return view('tamu.detailroom',compact('kamars','fasilitass'));
    }
    public function addorder(Request $request){
        // dd($request->all());
        $request->validate([
            'jumlah_penginap' => 'required|numeric',
            'rencanacheckin' => 'required',
            'rencanacheckout' => 'required',
            'lama_menginap' => 'required|numeric',
        ]);
        $order = new Booking;
        $order->kamar_id = $request->kamar_id;
        $order->jumlah_penginap = $request->jumlah_penginap;
        $order->rencanacheckin = $request->rencanacheckin;
        $order->rencanacheckout = $request->rencanacheckout;
        $order->totalharga = $order->kamar->hargakamarpermalam * $request->lama_menginap - $request->dp_dibayar;
        $order->lama_menginap = $request->lama_menginap;
        $order->dp_dibayar = $request->dp_dibayar;
        $order->kodebooking = mt_rand(100,5000);
        $order->user_id = Auth::id();
        // untuk membuat pesan tanggal mulai dari sekarang atau hari besok
        if ($order->rencanacheckin < (date("Y-m-d"))) {
            // dd("anda Tidak boleh");
            return redirect()->back()->with('fail','Tanggal Pesan Tidak Boleh Lebih dari Tanggal sebelumnya');
        }
        // untuk membuat checkout dan chekin harus berbeda
        // if ($order->rencanachekin == $order->rencanacheckout) {
        //     dd("anda boleh");
        // } else {
        //     dd("anda tidak boleh");
        // }
         // untuk membuat max user dalam memesan kamar
        if ($request->jumlah_penginap > $order->kamar->jumlahorangperkamar) {
            return redirect()->back()->with('fail','Kamar Gagal Di Pesan');
        } else {
            $order->save();
            return redirect()->back()->with('status','Kamar Berhasil Di Pesan');
        }
    }
}
