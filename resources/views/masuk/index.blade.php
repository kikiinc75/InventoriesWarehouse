@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 10
  });
} );
</script>
@stop
@section('title','App Inventaris | Inventaris Masuk')
@section('nav-masuk','active')
@extends('layouts.app')

@section('content')
<!-- datatables -->
@if(Session::has('message'))
<div class="alert alert-{{ Session::get('message_type') }} alert-dissmissible fade show" id="alert" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button><strong>Hey!</strong> {{Session::get('message')}}
</div>
@endif
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h1>Inventaris Masuk</h1>
    </div>
    <div class="widget-body">
        <a href="{{route('masuk.create')}}" class="btn btn-outline-primary mr-1 mb-2"><i class="la la-plus"></i>Tambah Data</a>
        @if(Auth::user()->id_level=='1')
        <button type="button" class="btn btn-secondary mr-1 mb-2" data-toggle="modal" style="float: right;" data-target="#laporan"><i class="la la-file-archive-o"></i><span>Generate Laporan</span></button>
        @endif
        <div class="table-responsive">
            <table id="table" class="table mb-0">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Supplier</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Tanggal Masuk</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($datas as $data)
                    <tr>
                        <td>{{$data->kode_masuk}}</td>
                        <td>{{$data->nama_supplier}}</td>
                        <td>{{$data->nama_inventaris}}</td>
                        <td>{{$data->nama_kategori}}</td>
                        <td>{{$data->jumlah_masuk}}</td>
                        <td>{{date('d/m/Y', strtotime($data->tanggal_masuk))}}</td>
                        <td class="td-actions">
                            <div class="btn-group dropdown">
                              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                                <a class="dropdown-item" href="{{route('masuk.edit', $data->id_masuk)}}"> Edit </a>
                                <form action="{{route('masuk.destroy', $data->id_masuk)}}" class="pull-left"  method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
<div id="laporan" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                   <h1> SMKN 1 Jenangan</h1>
               </div>
               <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                <span class="sr-only">close</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="export-table" class="table mb-0">
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Supplier</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>{{$data->kode_masuk}}</td>
                            <td>{{$data->nama_supplier}}</td>
                            <td>{{$data->nama_inventaris}}</td>
                            <td>{{$data->nama_kategori}}</td>
                            <td>{{$data->jumlah_masuk}}</td>
                            <td>{{date('d/m/Y', strtotime($data->tanggal_masuk))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<!-- End Datatables -->
@endsection