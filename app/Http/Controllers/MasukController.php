<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Masuk;
use App\Inventaris;
use App\Supplier;
use DB;
use Session;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class MasukController extends Controller
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
        $datas=DB::table('inventaris_masuk')
        ->join('suppliers','suppliers.id_supplier','=','inventaris_masuk.id_supplier')
        ->join('inventaris','inventaris.id_inventaris','=','inventaris_masuk.id_inventaris')
        ->join('kategori','kategori.id_kategori','=','inventaris.id_kategori')->get();
        return view('masuk.index',compact('datas'));
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
        $getRow = Masuk::orderBy('id_masuk', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "BM00001";
        
        if ($rowCount > 0) {
            if ($lastId->id_masuk < 9) {
                $kode = "BM0000".''.($lastId->id_masuk + 1);
            } else if ($lastId->id_masuk < 99) {
                $kode = "BM000".''.($lastId->id_masuk + 1);
            } else if ($lastId->id_masuk < 999) {
                $kode = "BM00".''.($lastId->id_masuk + 1);
            } else if ($lastId->id_masuk < 9999) {
                $kode = "BM0".''.($lastId->id_masuk + 1);
            } else {
                $kode = "BM".''.($lastId->id_masuk + 1);
            }
        }
        $supplier=Supplier::get();
        $inventaris=Inventaris::get();
        return view('masuk.create',compact('supplier','inventaris','kode'));
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
            'id_supplier' => 'required',
            'id_inventaris' => 'required',
            'kode_masuk'=>'required',
            'tanggal_masuk'=>'required',
            'jumlah_masuk'=>'required'
        ]);
        Masuk::create($request->all());
        Session::flash('message','Data barang berhasil didaftarkan!');
        Session::flash('message_type','success');
        return redirect()->route('masuk.index');
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
        $data=DB::table('inventaris_masuk')
        ->join('suppliers','suppliers.id_supplier','=','inventaris_masuk.id_supplier')
        ->join('inventaris','inventaris.id_inventaris','=','inventaris_masuk.id_inventaris')
        ->join('kategori','kategori.id_kategori','=','inventaris.id_kategori')
        ->where('id_masuk','=',$id)
        ->get();
        return view('masuk.edit',compact('data'));
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
        Masuk::find($id)->update($request->all());

        Session::flash('message', 'Jumlah berhasil diubah!');
        Session::flash('message_type', 'success');
        return redirect()->to('masuk');
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
        Masuk::find($id)->delete();
        Session::flash('message','Barang baru berhasil dihapus!');
        Session::flash('message_type','success');
        return redirect()->to('masuk');
    }
}
