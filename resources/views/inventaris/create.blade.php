@section('title','App Inventaris | Inventaris Baru')
@section('nav-inventaris','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Tambah Barang</h4>
    </div>
    <div class="widget-body">
        <form class="needs-validation" novalidate method="post" action="{{route('inventaris.store')}}" >
            @csrf
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kode Barang</label>
                <div class="col-lg-5">
                    <input type="text" name="kode_inventaris" value="{{$kode}}" class="form-control" placeholder="Masukkan kode" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Barang</label>
                <div class="col-lg-5">
                    <input type="text" name="nama_inventaris" class="form-control" placeholder="Masukkan nama" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kategori</label>
                <div class="col-lg-5">
                    <select name="id_kategori" class="selectpicker show-menu-arrow" data-live-search="true">
                        @foreach($kategori as $kategori)
                        <option value="{{$kategori->id_kategori}}">{{$kategori->kode_kategori}}-{{$kategori->nama_kategori}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Ruang</label>
                <div class="col-lg-5">
                    <select name="id_ruang" class="selectpicker show-menu-arrow" data-live-search="true">
                        @foreach($ruang as $ruang)
                        <option value="{{$ruang->id_ruang}}">{{$ruang->kode_ruang}}-{{$ruang->nama_ruang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Jumlah</label>
                <div class="col-lg-5">
                    <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Masuk</label>
                <div class="col-lg-5">
                    <input id="tanggal_register" type="date" class="form-control" name="tanggal_register" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kondisi</label>
                <div class="col-lg-8">
                    <select name="kondisi_inventaris" class="selectpicker show-menu-arrow">
                        <option value="fungsi">Berfungsi</option>
                        <option value="mid-fungsi">kurang berfungsi</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Submit</button>
                <button class="btn btn-shadow" type="reset">Reset</button>
                <a href="{{route('inventaris.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
    </div>
</div>
<!-- End Form -->
@endsection