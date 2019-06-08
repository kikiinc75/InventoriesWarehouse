<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventaris;
use App\Ruang;
use App\Kategori;
use DB;
use Session;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class InventarisController extends Controller
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
        $datas=DB::table('inventaris')
        ->join('ruang','ruang.id_ruang','=','inventaris.id_ruang')
        ->join('kategori','kategori.id_kategori','=','inventaris.id_kategori')->get();
        return view('inventaris.index',compact('datas'));
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
        $getRow = Inventaris::orderBy('id_inventaris', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "BR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id_inventaris < 9) {
                $kode = "BR0000".''.($lastId->id_inventaris + 1);
            } else if ($lastId->id_inventaris < 99) {
                $kode = "BR000".''.($lastId->id_inventaris + 1);
            } else if ($lastId->id_inventaris < 999) {
                $kode = "BR00".''.($lastId->id_inventaris + 1);
            } else if ($lastId->id_inventaris < 9999) {
                $kode = "BR0".''.($lastId->id_inventaris + 1);
            } else {
                $kode = "BR".''.($lastId->id_inventaris + 1);
            }
        }
        $ruang=Ruang::get();
        $kategori=Kategori::get();
        return view('inventaris.create',compact('ruang','kategori','kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = Inventaris::where('nama_inventaris',$request->input('nama_inventaris'))->count();
        if ($barang>0) {
            Session::flash('message','Barang sudah terdaftar!');
            Session::flash('message_type','danger');
            return redirect()->to('inventaris');
        }
        $this->validate($request,[
            'id_ruang'=>'required',
            'id_kategori'=>'required',
            'kode_inventaris'=>'required',
            'nama_inventaris' => 'required|string',
            'kondisi_inventaris'=>'required',
            'jumlah'=>'required'
        ]);
        Inventaris::create($request->all());
        Session::flash('message','Barang berhasil didaftarkan!');
        Session::flash('message_type','success');
        return redirect()->route('inventaris.index');
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
        $data=Inventaris::FindOrFail($id);
        $ruang=Ruang::get();
        $kategori=Kategori::get();
        return view('inventaris.edit',compact('data','ruang','kategori'));
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
        Inventaris::find($id)->update($request->all());
        Session::flash('message', 'Barang berhasil diubah!');
        Session::flash('message_type', 'success');
        return redirect()->route('inventaris.index');
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
        Inventaris::find($id)->detele();
        Session::flash('message','Barang berhasil dihapus!');
        Session::flash('message_type','success');
        return redirect()->route('inventaris.index');
    }
}
