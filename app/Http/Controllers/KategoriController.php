<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Session;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class KategoriController extends Controller
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
        $datas=Kategori::get();
        return view('kategori.index',compact('datas'));
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
        $getRow = Kategori::orderBy('id_kategori', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "KG00001";
        
        if ($rowCount > 0) {
            if ($lastId->id_kategori < 9) {
                $kode = "KG0000".''.($lastId->id_kategori + 1);
            } else if ($lastId->id_kategori < 99) {
                $kode = "KG000".''.($lastId->id_kategori + 1);
            } else if ($lastId->id_kategori < 999) {
                $kode = "KG00".''.($lastId->id_kategori + 1);
            } else if ($lastId->id_kategori < 9999) {
                $kode = "KG0".''.($lastId->id_kategori + 1);
            } else {
                $kode = "KG".''.($lastId->id_kategori + 1);
            }
        }
        return view('kategori.create',compact('kode'));
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
            'kode_kategori'=>'required',
            'nama_kategori'=>'required|string',
        ]);
        $nama=Kategori::where('nama_kategori',$request->input('nama_kategori'))->count();
        if ($nama>0) {
            Session::flash('message','Kategori sudah tersedia');
            Session::flash('message_type','danger');
        }
        else{
            Kategori::create($request->all());
            Session::flash('message','Kategori berhasil ditambahkan!');
            Session::flash('message_type','success');
        }
        return redirect()->route('kategori.index');
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
        $data=Kategori::findorfail($id);
        return view('kategori.edit',compact('data'));
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
        $nama=Kategori::where('nama_kategori',$request->input('nama_kategori'))->count();
        if ($nama>0) {
            Session::flash('message','Kategori sudah tersedia');
            Session::flash('message_type','danger');
        }
        else{
            Kategori::find($id)->update($request->all());
            Session::flash('message','Kategori berhasil diubah!');
            Session::flash('message_type','success');
        }
        return redirect()->route('kategori.index');
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
        Kategori::find($id)->delete();
        Session::flash('message','Kategori berhasil dihapus!');
        Session::flash('message_type','success');
        return redirect()->route('kategori.index');
    }
}
