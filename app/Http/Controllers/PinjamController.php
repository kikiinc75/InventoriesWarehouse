<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pinjam;
use App\User;
use App\Inventaris;
use DB;
use Session;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class PinjamController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id_level=='3') {
            $datas=DB::table('peminjaman')
            ->join('users','users.id','=','peminjaman.id')
            ->join('inventaris','inventaris.id_inventaris','=','peminjaman.id_inventaris')
            ->where('peminjaman.id','=',Auth::user()->id)
            ->get();
        }
        elseif (Auth::user()->id_level=='2') {
            $datas=DB::table('peminjaman')
            ->join('users','users.id','=','peminjaman.id')
            ->join('inventaris','inventaris.id_inventaris','=','peminjaman.id_inventaris')
            ->where('id_level','!=','1')
            ->get();
        }
        else{
            $datas=DB::table('peminjaman')
            ->join('users','users.id','=','peminjaman.id')
            ->join('inventaris','inventaris.id_inventaris','=','peminjaman.id_inventaris')
            ->get();
        }
        return view('pinjam.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Pinjam::orderBy('id_pinjam', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "PJ00001";
        
        if ($rowCount > 0) {
            if ($lastId->id_pinjam < 9) {
                $kode = "PJ0000".''.($lastId->id_pinjam + 1);
            } else if ($lastId->id_pinjam < 99) {
                $kode = "PJ000".''.($lastId->id_pinjam + 1);
            } else if ($lastId->id_pinjam < 999) {
                $kode = "PJ00".''.($lastId->id_pinjam + 1);
            } else if ($lastId->id_pinjam < 9999) {
                $kode = "PJ0".''.($lastId->id_pinjam + 1);
            } else {
                $kode = "PJ".''.($lastId->id_pinjam + 1);
            }
        }
        if (Auth::user()->id_level=='2') {
            $user=User::where('id_level','!=','1')->get();
        }
        else{
            $user=User::get();
        }
        $inventaris=Inventaris::where('jumlah','>',0)->get();
        return view('pinjam.create',compact('inventaris','kode','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
            'id_inventaris' => 'required',
            'kode_pinjam'=>'required',
            'jumlah_pinjam'=>'required',
            'tujuan' => 'required',
            'tanggal_pinjam'=>'required',
            'tanggal_kembali'=>'required',
        ]);
        $jumlah=DB::table('inventaris')
        ->select('jumlah')
        ->where('id_inventaris','=',$request->get('id_inventaris'))
        ->first()->jumlah;
        if ($request->get('jumlah_pinjam')>$jumlah) {
            Session::flash('message','Barang terlalu banyak!');
            Session::flash('message_type','danger');
        }
        else{
            Pinjam::create([
                'id'=>$request->input('id'),
                'id_inventaris'=>$request->input('id_inventaris'),
                'kode_pinjam'=>$request->input('kode_pinjam'),
                'jumlah_pinjam'=>$request->input('jumlah_pinjam'),
                'tujuan'=>$request->input('tujuan'),
                'tanggal_pinjam'=>$request->input('tanggal_pinjam'),
                'tanggal_kembali'=>$request->input('tanggal_kembali'),
                'status'=>'pinjam'
            ]);
            Session::flash('message','Peminjaman berhasil ditambahkan!');
            Session::flash('message_type','success');
        }
        return redirect()->route('pinjam.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id_level=='3') {
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->id_level=='3') {
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('pinjam');
        }
        Pinjam::find($id)->update([
            'tanggal_kembali'=>$request->input('tanggal_kembali'),
            'status'=>'kembali',
        ]);
        Session::flash('message','Peminjaman berhasil dikembalikan!');
        Session::flash('message_type','success');
        return redirect()->route('pinjam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id_level!='1') {
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('home');
        }
        else{
            Pinjam::find($id)->delete();
            Session::flash('message','Peminjaman berhasil dihapus!');
            Session::flash('message_type','success');
            return redirect()->route('pinjam.index');
        }
    }
}
