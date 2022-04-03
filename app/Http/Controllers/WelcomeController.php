<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailKamarOrder;
use App\Models\Fasilitas;
use App\Services\LogActivitiesServices\MainLogActivitiesServices;
use Illuminate\Http\Request;
use App\Models\FasilitasUmum;
use App\Models\Kamar;
use App\Models\KamarOrder;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
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
        // $order->kodebooking = mt_rand(100,5000);
        $order->user_id = Auth::id();
        // untuk membuat pesan tanggal mulai dari sekarang atau hari besok
        if ($order->rencanacheckin < (date("Y-m-d"))) {
            // dd("anda Tidak boleh");
            return redirect()->back()->with('fail','Tanggal Pesan Tidak Boleh Lebih dari Tanggal sebelumnya');
        }
        if ($order->rencanacheckout < (date("Y-m-d"))) {
            // dd("anda Tidak boleh");
            return redirect()->back()->with('fail','Tanggal Pesan Tidak Boleh Kurang dari Tanggal Hari ini');
        }
        if ($order->rencanacheckout == $order->rencanacheckin) {
            return redirect()->back()->with('fail','Minimal Pemesanan 1 Hari');
        }
        if ($order->rencanacheckout < $order->rencanacheckin) {
            return redirect()->back()->with('fail','checkout dilarang kurang dari checkin');
        }
        
// untuk membuat jumlah penginap pas dengan jumlah orang
        if ($request->jumlah_penginap > $order->kamar->jumlahorangperkamar) {
            return redirect()->back()->with('fail','Kamar Gagal Di Pesan');
        } else {
            $order->save();
            return redirect('tamu.home')->with('status','Kamar Berhasil Di Pesan');
        }
    }
    public function removeorder($id){
        $order = Booking::find($id);
        $orderkamar = DetailKamarOrder::where('bookings_id',$id);
        $order->delete();
        $orderkamar->delete();
        return redirect('tamu.home')->with('status','Pesanan Kamar Berhasil di batalkan');
    }
    public function buktibooking(){
        $user = Auth::user()->id;
        $bookings = Booking::where('user_id',$user)->paginate();
        return view('tamu.buktibooking',compact('bookings'));
    }
    public function insertbooking(Request $request){
        // dd("DUMP DIE SUDAH BERFUNGSI");
        $data = $request->all();
        // dd($data);
        $kamarorders = new KamarOrder;
        $kamarorders->booking_kode = $data['booking_kode'];
        $kamarorders->user_id = $data['user_id'];
        $kamarorders->status = 'uncorfirmed';
        $kamarorders->statuspembayaran = 'belumlunas';
        $kamarorders->save();
        if (count($data['bookings_id']) > 0) {
            foreach ($data['bookings_id'] as $item => $value) {
                $databooking = array(
                    'kamar_orders_id' => $kamarorders->id,
                    'bookings_id' => $data['bookings_id'][$item],
                    // 'kamars_id' => null,
                    'tanggal_checkin' => $data['tanggal_checkin'][$item],
                    'tanggal_checkout' => $data['tanggal_checkout'][$item],
                    'user_id' => Auth::id()
                );
                DetailKamarOrder::create($databooking);
            }
            return redirect('tamu.home')->with('status','Cetak Pembayaran Berhasil');
        }
    }
    public function kamarpdf($id){
        $kamarorder = KamarOrder::with('detailkamarorder')->where('id',$id)->first();
        $pdf = FacadePdf::loadview('tamu.laporanbooking',compact('kamarorder'));
        return $pdf->stream();
        // return view('tamu.laporanbooking',compact('pdf'));
    }

    // khusus resepsionis
    public function datatamu(){
        $kamarorders = KamarOrder::with('detailkamarorder')->latest()->paginate();
        return view('resepsionis.datatamu',compact('kamarorders'));
    }
    public function tambahpembayaran(Request $request,$id){
        $tambahpembayaran = KamarOrder::find($id);
        $tambahpembayaran->jumlahdibayar = $request->jumlahdibayar;
        $tambahpembayaran->metodepembayaran = $request->metodepembayaran;
        $tambahpembayaran->statuspembayaran = "lunas";
        $tambahpembayaran->resepsionis_id = Auth::user()->id;
        $tambahpembayaran->status = $request->status;
        $tambahpembayaran->save();
        return redirect()->back()->with('status','Pembayaran Berhasil Di Tambah');
    }
    public function datakamar(){
        $kamars = Kamar::all();
        return view('resepsionis.datakamar',compact('kamars'));
    }
    public function cari(Request $request){
        $cari = $request->cari;
        
        $kamars = Kamar::where('nokamar','like',"%".$cari."%")->paginate();
        return view('resepsionis.datakamar',compact('kamars'));
    }
    public function updatestatus(Request $request,$id){
        $kamars = Kamar::find($id);
        $kamars->status = $request->status;
        $kamars->save();
        return redirect('resepsionis.datakamar')->with('status','Kamar Berhasil Di ubah');
    }
}
