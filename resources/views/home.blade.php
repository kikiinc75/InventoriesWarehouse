@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 10
  });
} );
</script>
@stop
@section('title','App Inventaris | Dashboard')
@section('nav-dashboard','active')
@extends('layouts.app')

@section('content')
<!-- Begin Page Header-->
<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Dashboard</h2>
        </div>
    </div>
</div>
<!-- End Page Header -->
<!-- Begin Row -->
<div class="row flex-row">
    @if(Auth::user()->id_level=='1')
    <!-- Begin barang -->
    <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
            <a href="{{route('inventaris.index')}}">
                <div class="widget-body">
                    <div class="media">
                        <div class="align-self-center ml-5 mr-5">
                            <i class="ti-archive text-twitter"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="title text-twitter">Barang</div>
                            <div class="number">{{$barang}} Buah</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- End barang -->
    <!-- Begin peminjaman -->
    <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
            <a href="{{route('pinjam.index')}}">
                <div class="widget-body">
                    <div class="media">
                        <div class="align-self-center ml-5 mr-5">
                            <i class="ti-shopping-cart-full text-twitter"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="title text-twitter">Peminjaman</div>
                            <div class="number">{{$pinjam}} Transaksi</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- End peminjaman -->
    <!-- Begin user -->
    <div class="col-xl-4 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
            <a href="{{route('user.index')}}">
                <div class="widget-body">
                    <div class="media">
                        <div class="align-self-center ml-5 mr-5">
                            <i class="ti ti-user text-twitter"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="title text-twitter">User</div>
                            <div class="number">{{$user}} Orang</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- End user -->
    @else
    <!-- Begin barang -->
    <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
            <a href="{{route('inventaris.index')}}">
                <div class="widget-body">
                    <div class="media">
                        <div class="align-self-center ml-5 mr-5">
                            <i class="ti-archive text-twitter"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="title text-twitter">Barang</div>
                            <div class="number">{{$barang}} Buah</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- End barang -->
    <!-- Begin peminjaman -->
    <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="widget widget-12 has-shadow">
            <a href="{{route('pinjam.index')}}">
                <div class="widget-body">
                    <div class="media">
                        <div class="align-self-center ml-5 mr-5">
                            <i class="ti-shopping-cart-full text-twitter"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="title text-twitter">Peminjaman</div>
                            <div class="number">{{$pinjam}} Transaksi</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- End peminjaman -->
    @endif
</div>
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h1>Peminjaman</h1>
    </div>
    <div class="widget-body">
        <div class="table-responsive">
            <table id="table" class="table mb-0">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Penaggung jawab</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Pinjam</th>
                        <th>Tujuan</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>{{$data->kode_pinjam}}</td>
                            <td>{{$data->nama_user}}</td>
                            <td>{{$data->nama_inventaris}}</td>
                            <td>{{$data->jumlah_pinjam}}</td>
                            <td>{{$data->tujuan}}</td>
                            <td>{{date('d/m/Y', strtotime($data->tanggal_pinjam))}}</td>
                            <td>{{date('d/m/Y', strtotime($data->tanggal_kembali))}}</td>
                            <td>@if($data->status=='pinjam')
                              <span class="badge-text badge-text-small info">
                                Pinjam
                            </span>
                            @elseif($data->status=='kembali')
                            <span class="badge-text badge-text-small success">
                                Kembali
                            </span>
                        @endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- End Row -->
@endsection
