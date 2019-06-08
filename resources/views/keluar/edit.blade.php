@section('title','App Inventaris | Barang Keluar')
@section('nav-masuk','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Edit Barang Keluar</h4>
    </div>
    <div class="widget-body">
        @foreach($data as $data)
        <form class="needs-validation" novalidate method="post" action="{{route('keluar.update',$data->id_keluar)}}" >
            @csrf
            {{method_field('put')}}
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kode Transaksi</label>
                <div class="col-lg-5">
                    <input type="text" name="kode_keluar" value="{{$data->kode_keluar}}" class="form-control" placeholder="Masukkan kode" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Barang</label>
                <div class="col-lg-5">
                    <input type="hidden" name="id_inventaris" value="{{$data->id_inventaris}}" class="form-control" placeholder="Masukkan penerima" required>
                    <input type="text" value="{{$data->nama_inventaris}}" class="form-control" placeholder="Masukkan penerima" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Penerima</label>
                <div class="col-lg-5">
                    <input type="text" name="penerima" value="{{$data->penerima}}" class="form-control" placeholder="Masukkan penerima" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Keperluan</label>
                <div class="col-lg-5">
                    <input type="text" name="keperluan" value="{{$data->keperluan}}" class="form-control" placeholder="Masukkan keperluan" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Jumlah</label>
                <div class="col-lg-5">
                    <input type="hidden" name="old_jumlah" class="form-control" value="{{$data->jumlah_keluar}}" readonly>
                    <input type="number" name="jumlah_keluar" class="form-control" value="{{$data->jumlah_keluar}}" placeholder="Masukkan jumlah" required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Tanggal Keluar</label>
                <div class="col-lg-5">
                    <input id="tanggal_keluar" type="date" class="form-control" name="tanggal_keluar" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" readonly required>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Update</button>
                <a href="{{route('keluar.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
        @endforeach
    </div>
</div>
<!-- End Form -->
@endsection