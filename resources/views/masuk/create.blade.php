@section('title','App Inventaris | Barang Baru')
@section('nav-masuk','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Tambah Barang Baru</h4>
    </div>
    <div class="widget-body">
        <form class="needs-validation" novalidate method="post" action="{{route('masuk.store')}}" >
            @csrf
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kode Transaksi</label>
                <div class="col-lg-5">
                    <input type="text" name="kode_masuk" value="{{$kode}}" class="form-control" placeholder="Masukkan kode" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Supplier</label>
                <div class="col-lg-5">
                    <select name="id_supplier" class="selectpicker show-menu-arrow" data-live-search="true">
                        @foreach($supplier as $supplier)
                        <option value="{{$supplier->id_supplier}}">{{$supplier->kode_supplier}}-{{$supplier->nama_supplier}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Barang</label>
                <div class="col-lg-5">
                    <select name="id_inventaris" class="selectpicker show-menu-arrow" data-live-search="true">
                        @foreach($inventaris as $barang)
                        <option value="{{$barang->id_inventaris}}">{{$barang->kode_inventaris}}-{{$barang->nama_inventaris}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Jumlah</label>
                <div class="col-lg-5">
                    <input type="number" name="jumlah_masuk" class="form-control" placeholder="Masukkan jumlah" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Masuk</label>
                <div class="col-lg-5">
                    <input id="tanggal_masuk" type="date" class="form-control" name="tanggal_masuk" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Submit</button>
                <button class="btn btn-shadow" type="reset">Reset</button>
                <a href="{{route('masuk.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
    </div>
</div>
<!-- End Form -->
@endsection