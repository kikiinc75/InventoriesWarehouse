<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruang;
use Session;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class RuangController extends Controller
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
        $datas=Ruang::get();
        return view('ruang.index',compact('datas'));
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
        $getRow = Ruang::orderBy('id_ruang', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "RG00001";
        
        if ($rowCount > 0) {
            if ($lastId->id_ruang < 9) {
                $kode = "RG0000".''.($lastId->id_ruang + 1);
            } else if ($lastId->id_ruang < 99) {
                $kode = "RG000".''.($lastId->id_ruang + 1);
            } else if ($lastId->id_ruang < 999) {
                $kode = "RG00".''.($lastId->id_ruang + 1);
            } else if ($lastId->id_ruang < 9999) {
                $kode = "RG0".''.($lastId->id_ruang + 1);
            } else {
                $kode = "RG".''.($lastId->id_ruang + 1);
            }
        }
        return view('ruang.create',compact('kode'));
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
            'kode_ruang'=>'required',
            'nama_ruang'=>'required|string',
        ]);
        $nama=Ruang::where('nama_ruang',$request->input('nama_ruang'))->count();
        if ($nama>0) {
            Session::flash('message','Ruang sudah tersedia');
            Session::flash('message_type','danger');
        }
        else{
            Ruang::create($request->all());
            Session::flash('message','Ruang berhasil ditambahkan!');
            Session::flash('message_type','success');
        }
        return redirect()->route('ruang.index');
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
        $data=Ruang::findorfail($id);
        return view('ruang.edit',compact('data'));
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
        $nama=Ruang::where('nama_ruang',$request->input('nama_ruang'))->count();
        if ($nama>0) {
            Session::flash('message','Ruang sudah tersedia');
            Session::flash('message_type','danger');
        }
        else{
            Ruang::find($id)->update($request->all());
            Session::flash('message','Ruang berhasil diubah!');
            Session::flash('message_type','success');
        }
        return redirect()->route('ruang.index');
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
        Ruang::find($id)->delete();
        Session::flash('message','Ruang berhasil dihapus!');
        Session::flash('message_type','success');
        return redirect()->route('kategori.index');
    }
}
