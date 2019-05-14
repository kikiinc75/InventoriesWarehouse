@section('title','App Inventaris | Supplier Baru')
@section('nav-supplier','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Tambah Supplier</h4>
    </div>
    <div class="widget-body">
        <form class="needs-validation" novalidate method="post" action="{{route('supplier.store')}}" >
            @csrf
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kode Supplier</label>
                <div class="col-lg-5">
                    <input type="text" name="kode_supplier" value="{{$kode}}" class="form-control" placeholder="Masukkan kode" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Supplier</label>
                <div class="col-lg-5">
                    <input type="text" name="nama_supplier" class="form-control" placeholder="Masukkan nama" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Alamat</label>
                <div class="col-lg-5">
                    <input type="text" name="alamat_supplier" class="form-control" placeholder="Masukkan alamat" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kota</label>
                <div class="col-lg-5">
                    <select name="id_kota" class="selectpicker show-menu-arrow" data-live-search="true">
                        @foreach($kota as $kota)
                        <option value="{{$kota->id_kota}}">{{$kota->kode_kota}}-{{$kota->nama_kota}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">No. Telp</label>
                <div class="col-lg-5">
                    <small class="d-block mt-costume">Example <code>6283854557795</code></small>
                    <div class="input-group">
                        <span class="input-group-addon addon-primary">
                            <i class="la la-phone"></i>
                        </span>
                        <input type="number" name="no_telp" class="form-control" placeholder="Phone number">
                    </div>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Submit</button>
                <button class="btn btn-shadow" type="reset">Reset</button>
                <a href="{{route('supplier.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
    </div>
</div>
<!-- End Form -->
@endsection