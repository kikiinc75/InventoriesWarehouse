<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pinjam;
use App\Inventaris;
use DB;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=User::get()->count();
        $barang=DB::table('inventaris')->sum('jumlah');
        $show= pinjam::where('id',Auth::user()->id)->get()->count();
        if ($show>0) {
            if (Auth::user()->id_level=='3') {
                $datas=DB::table('peminjaman')
                ->join('users','users.id','=','peminjaman.id')
                ->join('inventaris','inventaris.id_inventaris','=','peminjaman.id_inventaris')
                ->where('peminjaman.id','=',Auth::user()->id)
                ->get();
                $pinjam=Pinjam::where('id','=',Auth::user()->id)->count();
            }
            elseif (Auth::user()->id_level=='2') {
                $datas=DB::table('peminjaman')
                ->join('users','users.id','=','peminjaman.id')
                ->join('inventaris','inventaris.id_inventaris','=','peminjaman.id_inventaris')
                ->where('id_level','!=','1')
                ->get();
                $pinjam=$datas->count();
            }
            else{
                $datas=DB::table('peminjaman')
                ->join('users','users.id','=','peminjaman.id')
                ->join('inventaris','inventaris.id_inventaris','=','peminjaman.id_inventaris')
                ->get();
                $pinjam=Pinjam::get()->count();
            }
        }
        return view('home',compact('user','pinjam','barang','datas','show'));
    }
}
