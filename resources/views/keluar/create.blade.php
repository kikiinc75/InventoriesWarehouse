@section('title','App Inventaris | Barang Keluar')
@section('nav-masuk','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Tambah Barang Keluar</h4>
    </div>
    <div class="widget-body">
        <form class="needs-validation" novalidate method="post" action="{{route('keluar.store')}}" >
            @csrf
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kode Transaksi</label>
                <div class="col-lg-5">
                    <input type="text" name="kode_keluar" value="{{$kode}}" class="form-control" placeholder="Masukkan kode" readonly required>
                </div>
            </div>
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
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Penerima</label>
                <div class="col-lg-5">
                    <input type="text" name="penerima" class="form-control" placeholder="Masukkan penerima" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Keperluan</label>
                <div class="col-lg-5">
                    <input type="text" name="keperluan" class="form-control" placeholder="Masukkan keperluan" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Jumlah</label>
                <div class="col-lg-5">
                    <input type="number" name="jumlah_keluar" class="form-control" placeholder="Masukkan jumlah" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Keluar</label>
                <div class="col-lg-5">
                    <input id="tanggal_keluar" type="date" class="form-control" name="tanggal_keluar" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Submit</button>
                <button class="btn btn-shadow" type="reset">Reset</button>
                <a href="{{route('keluar.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
    </div>
</div>
<!-- End Form -->
@endsection