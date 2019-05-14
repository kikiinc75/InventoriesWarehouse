<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keluar;
use App\Inventaris;
use DB;
use Session;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class KeluarController extends Controller
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
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('home');
        }
        $datas=DB::table('inventaris_keluar')
        ->join('inventaris','inventaris.id_inventaris','=','inventaris_keluar.id_inventaris')
        ->get();
        return view('keluar.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->id_level=='3') {
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('home');
        }
        $getRow = Keluar::orderBy('id_keluar', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "KR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id_keluar < 9) {
                $kode = "KR0000".''.($lastId->id_keluar + 1);
            } else if ($lastId->id_keluar < 99) {
                $kode = "KR000".''.($lastId->id_keluar + 1);
            } else if ($lastId->id_keluar < 999) {
                $kode = "KR00".''.($lastId->id_keluar + 1);
            } else if ($lastId->id_keluar < 9999) {
                $kode = "KR0".''.($lastId->id_keluar + 1);
            } else {
                $kode = "KR".''.($lastId->id_keluar + 1);
            }
        }
        $inventaris=Inventaris::where('jumlah','>',0)->get();
        return view('keluar.create',compact('inventaris','kode'));
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
            'id_inventaris' => 'required',
            'penerima' => 'required',
            'keperluan'=> 'required',
            'tanggal_keluar'=>'required',
            'jumlah_keluar'=>'required',
            'kode_keluar'=>'required'
        ]);
        $jumlah=DB::table('inventaris')
        ->select('jumlah')
        ->where('id_inventaris','=',$request->get('id_inventaris'))
        ->first()->jumlah;
        if ($request->get('jumlah_keluar')>$jumlah) {
            Session::flash('message','Barang terlalu banyak!');
            Session::flash('message_type','danger');
        }
        else{
            Keluar::create($request->all());
            Session::flash('message','Barang keluar berhasil ditambahkan!');
            Session::flash('message_type','success');
        }
        return redirect()->route('keluar.index');
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
        $data=DB::table('inventaris_keluar')
        ->join('inventaris','inventaris.id_inventaris','=','inventaris_keluar.id_inventaris')
        ->where('id_keluar','=',$id)
        ->get();
        return view('keluar.edit',compact('data'));
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
        $jumlah=DB::table('inventaris')
        ->select('jumlah')
        ->where('id_inventaris','=',$request->get('id_inventaris'))
        ->first()->jumlah;
        $old_jumlah=$jumlah+$request->get('old_jumlah');
        if ($request->get('jumlah_keluar')>$old_jumlah) {
            Session::flash('message','Barang terlalu banyak!');
            Session::flash('message_type','danger');
        }
        else{
            Keluar::find($id)->update($request->all());
            Session::flash('message', 'Jumlah berhasil diubah!');
            Session::flash('message_type', 'success');
        }
        return redirect()->route('keluar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id_level=='3') {
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('home');
        }
        Keluar::find($id)->delete();
        Session::flash('message','Data berhasil dihapus!');
        Session::flash('message_type','success');
        return redirect()->route('keluar.index');
    }
}
