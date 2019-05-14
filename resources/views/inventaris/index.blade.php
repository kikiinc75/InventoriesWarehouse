@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 10
    });
  } );
</script>
@stop
@section('title','App Inventaris | Inventaris')
@section('nav-inventaris','active')
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
    <h1>Inventaris</h1>
  </div>
  <div class="widget-body">
    @if(Auth::user()->id_level!='3')
    <a href="{{route('inventaris.create')}}" class="btn btn-outline-primary mr-1 mb-2"><i class="la la-plus"></i>Tambah Data</a>
    @endif
    @if(Auth::user()->id_level=='1')
    <button type="button" class="btn btn-secondary mr-1 mb-2" data-toggle="modal" style="float: right;" data-target="#laporan"><i class="la la-file-archive-o"></i><span>Generate Laporan</span></button>
    @endif
    <div class="table-responsive">
      <table id="table" class="table mb-0">
        <thead>
          <tr>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Ruang</th>
            <th>Jumlah</th>
            <th>Tanggal Registrasi</th>
            <th>Kondisi</th>
            @if(Auth::user()->id_level!='3')
            <th>Actions</th>
            @endif
          </tr>
        </thead>
        <tbody>
         @foreach($datas as $data)
         <tr>
          <td>{{$data->kode_inventaris}}-{{$data->nama_inventaris}}</td>
          <td>{{$data->nama_kategori}}</td>
          <td>{{$data->nama_ruang}}</td>
          <td>{{$data->jumlah}}</td>
          <td>{{date('d/m/Y', strtotime($data->tanggal_register))}}</td>
          <td>
            @if($data->kondisi_inventaris=='fungsi')
            <span class="badge-text badge-text-small success">
              Berfungsi
            </span>
            @elseif($data->kondisi_inventaris=='mid-fungsi')
            <span class="badge-text badge-text-small info">
              Kurang Berfungsi
            </span>
            @else
            <span class="badge-text badge-text-small danger">
              Rusak
            </span>
            @endif
          </td>
          @if(Auth::user()->id_level!='3')
          <td class="td-actions">
            <div class="btn-group dropdown">
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
              </button>
              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                <a class="dropdown-item" href="{{route('inventaris.edit', $data->id_inventaris)}}"> Edit </a>
                <form action="{{route('inventaris.destroy', $data->id_inventaris)}}" class="pull-left"  method="post">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
                  <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                  </button>
                </form>
              </div>
            </div>
          </td>
          @endif
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
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Ruang</th>
              <th>Jumlah</th>
              <th>Tanggal Registrasi</th>
              <th>Kondisi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($datas as $data)
            <tr>
              <td>{{$data->kode_inventaris}}-{{$data->nama_inventaris}}</td>
              <td>{{$data->nama_kategori}}</td>
              <td>{{$data->nama_ruang}}</td>
              <td>{{$data->jumlah}}</td>
              <td>{{date('d/m/Y', strtotime($data->tanggal_register))}}</td>
              <td>
                @if($data->kondisi_inventaris=='fungsi')
                <span class="badge-text badge-text-small success">
                  Berfungsi
                </span>
                @elseif($data->kondisi_inventaris=='mid-fungsi')
                <span class="badge-text badge-text-small info">
                  Kurang Berfungsi
                </span>
                @else
                <span class="badge-text badge-text-small danger">
                  Rusak
                </span>
                @endif
              </td>
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