<?php

namespace App\Http\Controllers;

use App\Models\GuestBooking;
use App\Models\GuestCetakPdf;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

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
            'kodebooking' => 'required',
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
        $booking->kodebooking = $request->kodebooking;
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
    public function delete(Request $request){
        $request->validate([
            'kodebooking' => 'required|numeric',
        ]);
        $id = $request->input('id');
        $guest = GuestBooking::find($id);
        $guest->kodebooking = $request->input('kodebooking');
        $guest->kodedelete = $request->input('kodedelete');
        if ($guest->kodebooking == $guest->kodedelete) {
            // dd("bisa di hapus");
            $guest->delete();
            return redirect('guestorder')->with('status','Pesanan Berhasil Dibatalkan');
        } else {
            // dd("nggak bisa di hapus");
            return redirect('guestorder')->with('fail','Pesanan Gagal Dibatalkan');
        }
    }
    public function cancel($id){
        $guest = GuestBooking::find($id);
        return response()->json([
            'status' => 200,
            'guest' => $guest
        ]);
    }
    public function cetakpdf(Request $request){
        $request->validate([
            'guest_bookings_id' => 'required',
            // 'kata' => 'required',
        ]);
        // $data = $request->all();
        // $guestpdf = new GuestCetakPdf;
        // $guestpdf->guest_bookings_id = implode(',',$data['guest_bookings_id']);
        // $guestpdf->kata = implode(',',$data['kata']);
        // $guestpdf->save();
        if (!empty($request->input('guest_bookings_id'))) {
            $will_insert = [];
            foreach ($request->input('guest_bookings_id') as $key => $value) {
                array_push($will_insert,['guest_bookings_id'=>$value]);
            }
            GuestCetakPdf::insert($will_insert);
        } else {
            $checkbox = '';
        }
        
        return redirect('guestorderpdf')->with('status','Laporan Pdf Berhasil Di Cetak');
    }
    public function dapatkanpdf(){
        $pdf = GuestCetakPdf::with('guest')->get();
        $pdfs = GuestBooking::all();
        return view('guest.pdf',compact('pdf','pdfs'));
    }
    public function addkodebooking(Request $request,$id){
        $orderkbguest = GuestCetakPdf::find($id);
        $orderkbguest->kodeupdate = $orderkbguest->guest->kodebooking;
        $orderkbguest->kodebooking = $request->kodebooking;
        // $orderkbguest->save();
        if ($orderkbguest->kodeupdate == $orderkbguest->kodebooking) {
            // echo "bisa";
            $orderkbguest->save();
        } else {
            return redirect('guestorderpdf')->with('fail','kode booking gagal di dapatkan');
            // echo "tidak bisa";
        }
        
        return redirect('guestorderpdf')->with('status','kode booking berhasil di tambahkan dan silahkan bawa bukti untuk ke hotel');
    }
}
