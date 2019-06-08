<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use Session;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class LevelController extends Controller
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
        $datas=Level::get();
        $count=Level::get()->count();
        return view('level.index',compact('datas','count'));
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
        $count = Level::get()->count();
        if (Auth::user()->id_level!='1'||$count>2) {
            Session::flash('message', 'Anda Dilarang Melakukan ini!');
            Session::flash('message_type', 'danger');
            return redirect()->to('level');
        }   
        return view('level.create');
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
            'nama_level'=>'required'
        ]);
        $count=Level::where('nama_level',$request->input('nama_level'))->count();
        if ($count>0) {
            Session::flash('message','Level sudah tersedia');
            Session::flash('message_type','danger');
        }
        else{
            Level::create($request->all());
            Session::flash('message','Level berhasil ditambahkan!');
            Session::flash('message_type','success');
        }
        return redirect()->route('level.index');
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
        $data=Level::FindOrFail($id);
        return view('level.edit',compact('data'));
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
        Level::find($id)->update($request->all());
        Session::flash('message','Level berhasil diubah!');
        Session::flash('message_type','success');
        return redirect()->route('level.index');
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
        if (Auth::user()->id_level!=$id) {
            Level::find($id)->delete();
            Session::flash('message','Level berhasil dihapus!');
            Session::flash('message_type','success');
            return redirect()->route('level.index');
        }
        else{
            Session::flash('message','Level tidak dapat dihapus!');
            Session::flash('message_type','danger');
            return redirect()->route('level');
        }
        return redirect()->route('level.index');
    }
}
