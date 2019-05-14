@section('title','App Inventaris | Edit Kota')
@section('nav-kota','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Edit Kota</h4>
    </div>
    <div class="widget-body">
        <form class="needs-validation" novalidate method="post" action="{{route('kota.update',$data->id_kota)}}" >
            @csrf
            {{method_field('put')}}
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Kode Kota</label>
                <div class="col-lg-5">
                    <input type="text" name="kode_kota" value="{{$data->kode_kota}}" class="form-control" placeholder="Masukkan kode" readonly required>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Kota</label>
                <div class="col-lg-5">
                    <input type="text" name="nama_kota" class="form-control" value="{{$data->nama_kota}}" placeholder="Masukkan nama" required>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Update</button>
                <a href="{{route('kota.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
    </div>
</div>
<!-- End Form -->
@endsection