@section('title','App Inventaris | Barang Baru')
@section('nav-masuk','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Edit Barang</h4>
    </div>
    <div class="widget-body">
        @foreach($data as $data)
        <form class="needs-validation" novalidate method="post" action="{{route('masuk.update',$data->id_masuk)}}" >
            @csrf
            {{method_field('put')}}
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kode Transaksi</label>
                <div class="col-lg-5">
                    <input type="text" name="kode_masuk" value="{{$data->kode_masuk}}" class="form-control" placeholder="Masukkan kode" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Supplier</label>
                <div class="col-lg-5">
                    <input type="hidden" name="id_supplier" value="{{$data->id_supplier}}" class="form-control" readonly required>
                    <input type="text" value="{{$data->nama_supplier}}" class="form-control" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Barang</label>
                <div class="col-lg-5">
                    <input type="hidden" name="id_inventaris" value="{{$data->id_inventaris}}" class="form-control" readonly required>
                    <input type="text" value="{{$data->nama_inventaris}}" class="form-control" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Jumlah</label>
                <div class="col-lg-5">
                    <input type="number" name="jumlah_masuk" value="{{$data->jumlah_masuk}}" class="form-control" placeholder="Masukkan jumlah" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Masuk</label>
                <div class="col-lg-5">
                    <input id="tanggal_masuk" type="date" class="form-control" name="tanggal_masuk" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required readonly>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Update</button>
                <a href="{{route('masuk.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
        @endforeach
    </div>
</div>
<!-- End Form -->
@endsection