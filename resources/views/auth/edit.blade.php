@section('title','App Inventaris | User Baru')
@section('nav-user','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Tambah User</h4>
    </div>
    <div class="widget-body">
        <form class="needs-validation" novalidate method="post" action="{{route('user.update',$data->id)}}" >
            @csrf
            {{method_field('put')}}
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Lengkap</label>
                <div class="col-lg-5">
                    <input type="text" name="nama_user" value="{{$data->nama_user}}" class="form-control" placeholder="Masukkan nama" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Email</label>
                <div class="col-lg-5">
                    <input type="email" name="email" value="{{$data->email}}" class="form-control" placeholder="Masukkan email" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Username</label>
                <div class="col-lg-5">
                    <input type="text" name="username" value="{{$data->username}}" class="form-control" placeholder="Masukkan username" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Password</label>
                <div class="col-lg-5">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" >
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">NIP</label>
                <div class="col-lg-5">
                    <input type="number" name="nip" class="form-control" value="{{$data->nip}}" placeholder="Masukkan NIP">
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Alamat</label>
                <div class="col-lg-5">
                    <input type="text" name="alamat" class="form-control" value="{{$data->alamat}}" placeholder="Masukkan alamat" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Level</label>
                <div class="col-lg-8">
                    <select name="id_level" class="selectpicker show-menu-arrow">
                        @foreach($level as $level)
                        <option value="{{$level->id_level}}">{{$level->nama_level}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Update</button>
                <a href="{{route('user.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
    </div>
</div>
<!-- End Form -->
@endsection