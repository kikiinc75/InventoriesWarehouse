<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use Session;
use DB;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
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
        $datas=DB::table('users')->join('level','level.id_level','=','users.id_level')->get();
        return view('auth.user',compact('datas'));
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
        $level=Level::get();
        return view('auth.register',compact('level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username=User::where('username',$request->input('username'))->count();
        $email=User::where('email',$request->input('email'))->count();
        if ($username>0||$email>0) {
            Session::flash('message', 'Username atau Email Sudah Dipakai!!');
            Session::flash('message_type', 'danger');
            return redirect()->to('user');
        }
        $this->validate($request,[
            'nama_user'=>'required',
            'email'=>'required|string|email',
            'username'=>'required',
            'password'=>'required|string|min:6',
            'alamat'=>'required',
            'id_level'=>'required',
        ]);
        User::create([
            'id_level'=>$request->input('id_level'),
            'email'=>$request->input('email'),
            'username'=>$request->input('username'),
            'password'=>bcrypt($request->input('password')),
            'nama_user'=>$request->input('nama_user'),
            'nip'=>$request->input('nip'),
            'alamat'=>$request->input('alamat'),
        ]);
        Session::flash('message', 'User berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->to('user');
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
        $data=User::FindOrFail($id);
        $level=Level::get();
        return view('auth.edit',compact('data','level'));
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
        $user_data = User::findOrFail($id);
        $user_data->id_level=$request->input('id_level');
        $user_data->email = $request->input('email');
        $user_data->username = $request->input('username');
        if($request->input('password')) {
            $user_data->id_level = $request->input('id_level');
        }
        if($request->input('password')) {
            $user_data->password= bcrypt(($request->input('password')));
        }
        $user_data->nama_user=$request->input('nama_user');
        $user_data->nip=$request->input('nip');
        $user_data->alamat=$request->input('alamat');
        
        $user_data->update();
        Session::flash('message', 'User berhasil diubah!');
        Session::flash('message_type', 'success');
        if (Auth::user()->id==$id){
            Auth::logout();
            return redirect()->to('login');
        }
        return redirect()->to('user');
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
        if (Auth::user()->id!=$id&&Auth::user()->id_level=='1') {
            User::find($id)->delete();
            Session::flash('message', 'User berhasil  dihapus!');
            Session::flash('message_type', 'success');
        }
        else{
            Session::flash('message', 'Anda tidak bisa menghapus data User!');
            Session::flash('message_type', 'danger');
        }
        return redirect()->to('user');
    }
}
