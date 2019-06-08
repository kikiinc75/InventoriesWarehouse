<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kota;
use Session;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class KotaController extends Controller
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
        if (Auth::user()->id_level!='1') {
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('home');
        }
        $datas=Kota::get();
        return view('kota.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->id_level!='1') {
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('home');
        }
        $getRow = Kota::orderBy('id_kota', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "KT00001";
        
        if ($rowCount > 0) {
            if ($lastId->id_kota < 9) {
                $kode = "KT0000".''.($lastId->id_kota + 1);
            } else if ($lastId->id_kota < 99) {
                $kode = "KT000".''.($lastId->id_kota + 1);
            } else if ($lastId->id_kota < 999) {
                $kode = "KT00".''.($lastId->id_kota + 1);
            } else if ($lastId->id_kota < 9999) {
                $kode = "KT0".''.($lastId->id_kota + 1);
            } else {
                $kode = "KT".''.($lastId->id_kota + 1);
            }
        }
        return view('kota.create',compact('kode'));
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
            'kode_kota'=>'required',
            'nama_kota'=>'required|string',
        ]);
        $nama=Kota::where('nama_kota',$request->input('nama_kota'))->count();
        if ($nama>0) {
            Session::flash('message','Kota sudah tersedia');
            Session::flash('message_type','danger');
        }
        else{
            Kota::create($request->all());
            Session::flash('message','Kota berhasil ditambahkan!');
            Session::flash('message_type','success');
        }
        return redirect()->route('kota.index');
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
        if (Auth::user()->id_level!='1') {
            Alert::error('Opps..', 'Maaf anda tidak dapat mengakses halaman ini!!');
            return redirect()->to('home');
        }
        $data=Kota::findorfail($id);
        return view('kota.edit',compact('data'));
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
        $nama=Kota::where('nama_kota',$request->input('nama_kota'))->count();
        if ($nama>0) {
            Session::flash('message','Kota sudah tersedia');
            Session::flash('message_type','danger');
        }
        else{
            Kota::find($id)->update($request->all());
            Session::flash('message','Kota berhasil diubah!');
            Session::flash('message_type','success');
        }
        return redirect()->route('kota.index');
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
        Kota::find($id)->delete();
        Session::flash('message','Kota berhasil dihapus!');
        Session::flash('message_type','success');
        return redirect()->route('kota.index');
    }
}
