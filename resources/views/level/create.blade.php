@section('title','App Inventaris | Level Baru')
@section('nav-level','active')
@extends('layouts.app')

@section('content')
<!-- Form -->
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Tambah Level</h4>
    </div>
    <div class="widget-body">
        <form class="needs-validation" novalidate method="post" action="{{route('level.store')}}" >
            @csrf
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Nama Level</label>
                <div class="col-lg-5">
                    <input type="text" name="nama_level" class="form-control" placeholder="Masukkan nama" required>
                </div>
            </div>
            <div class="text-left">
                <button class="btn btn-gradient-01" type="submit">Submit</button>
                <button class="btn btn-shadow" type="reset">Reset</button>
                <a href="{{route('level.index')}}" class="btn btn-gradient-02 pull-right">Back</a>
            </div>
        </form>
    </div>
</div>
<!-- End Form -->
@endsection