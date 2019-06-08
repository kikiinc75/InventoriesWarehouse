@section('title','App Inventaris | Peminjaman Baru')
@section('nav-pinjam','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Tambah Peminjaman</h4>
    </div>
    <div class="widget-body">
        <form class="needs-validation" novalidate method="post" action="{{route('pinjam.store')}}" >
            @csrf
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kode Transaksi</label>
                <div class="col-lg-5">
                    <input type="text" name="kode_pinjam" value="{{$kode}}" class="form-control" placeholder="Masukkan kode" readonly required>
                </div>
            </div>
            @if(Auth::user()->id_level!='3')
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Penanggung jawab</label>
                <div class="col-lg-5">
                    <select name="id" class="selectpicker show-menu-arrow" data-live-search="true">
                        @foreach($user as $user)
                        <option value="{{$user->id}}">{{$user->nama_user}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @else
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Penanggung jawab</label>
                <div class="col-lg-5">
                    <input type="hidden" name="id" value="{{Auth::user()->id}}" class="form-control" readonly required>
                    <input type="text" value="{{Auth::user()->nama_user}}" class="form-control" readonly required>
                </div>
            </div>
            @endif
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Barang</label>
                <div class="col-lg-5">
                    <select name="id_inventaris" class="selectpicker show-menu-arrow" data-live-search="true">
                        @foreach($inventaris as $barang)
                        <option value="{{$barang->id_inventaris}}">{{$barang->nama_inventaris}} jumlah {{$barang->jumlah}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tujuan</label>
                <div class="col-lg-5">
                    <input type="text" name="tujuan" class="form-control" placeholder="Masukkan tujuan" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Jumlah</label>
                <div class="col-lg-5">
                    <input type="number" name="jumlah_pinjam" class="form-control" placeholder="Masukkan jumlah" required>
                </div>
            </div>
            @if(Auth::user()->id_level=='3')
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Pinjam</label>
                <div class="col-lg-5">
                    <input id="tanggal_kembali" readonly type="date" class="form-control" name="tanggal_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Kembali</label>
                <div class="col-lg-5">
                    <input id="tanggal_kembali" readonly type="date" class="form-control" name="tanggal_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(8)->toDateString())) }}" required>
                </div>
            </div>
            @else
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Pinjam</label>
                <div class="col-lg-5">
                    <input id="tanggal_kembali" type="date" class="form-control" name="tanggal_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Kembali</label>
                <div class="col-lg-5">
                    <input id="tanggal_kembali" type="date" class="form-control" name="tanggal_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(8)->toDateString())) }}" required>
                </div>
            </div>
            @endif
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Submit</button>
                <button class="btn btn-shadow" type="reset">Reset</button>
                <a href="{{route('pinjam.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
    </div>
</div>
<!-- End Form -->
@endsection