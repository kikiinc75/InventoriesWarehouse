<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Kota;
use Session;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
class SupplierController extends Controller
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
        $datas=DB::table('suppliers')->join('kota','kota.id_kota','=','suppliers.id_kota')->get();
        return view('supplier.index',compact('datas'));
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
        $getRow = Supplier::orderBy('id_supplier', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "SP00001";
        
        if ($rowCount > 0) {
            if ($lastId->id_supplier < 9) {
                $kode = "SP0000".''.($lastId->id_supplier + 1);
            } else if ($lastId->id_supplier < 99) {
                $kode = "SP000".''.($lastId->id_supplier + 1);
            } else if ($lastId->id_supplier < 999) {
                $kode = "SP00".''.($lastId->id_supplier + 1);
            } else if ($lastId->id_supplier < 9999) {
                $kode = "SP0".''.($lastId->id_supplier + 1);
            } else {
                $kode = "SP".''.($lastId->id_supplier + 1);
            }
        }
        $kota=Kota::get();
        return view('supplier.create',compact('kota','kode'));
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
            'id_kota'=>'required',
            'nama_supplier'=>'required|string',
            'kode_supplier'=>'required',
            'alamat_supplier'=>'required',
        ]);
        $nama=Supplier::where('nama_supplier',$request->input('nama_supplier'))->count();
        if ($nama>0) {
            Session::flash('message','Supplier sudah tersedia');
            Session::flash('message_type','danger');
        }
        else{
            Supplier::create($request->all());
            Session::flash('message','Supplier berhasil ditambahkan!');
            Session::flash('message_type','success');
        }
        return redirect()->route('supplier.index');
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
        $data=Supplier::FindOrFail($id);
        $kota=Kota::get();
        return view('supplier.edit',compact('data','kota'));
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
        Supplier::find($id)->update($request->all());
        Session::flash('message','Supplier berhasil diubah!');
        Session::flash('message_type','success');
        return redirect()->route('supplier.index');
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
        Supplier::find($id)->delete();
        Session::flash('message','Supplier berhasil dihapus!');
        Session::flash('message_type','success');
        return redirect()->route('supplier.index');
    }
}
