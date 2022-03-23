<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Services\LogActivitiesServices\MainLogActivitiesServices;
use Illuminate\Http\Request;
use App\Models\FasilitasUmum;
use App\Models\Kamar;

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
}
