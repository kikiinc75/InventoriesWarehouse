@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 10
    });
  } );
</script>
@stop
@section('title','App Inventaris | Kategori')
@section('nav-kategori','active')
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
    <h1>Kategori</h1>
  </div>
  <div class="widget-body">
    <a href="{{route('kategori.create')}}" class="btn btn-outline-primary mr-1 mb-2"><i class="la la-plus"></i>Tambah Data</a>
    <div class="table-responsive">
      <table id="table" class="table mb-0">
        <thead>
          <tr>
            <th>Nama Kategori</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
         @foreach($datas as $data)
         <tr>
          <td>{{$data->kode_kategori}}-{{$data->nama_kategori}}</td>
          <td class="td-actions">
            <div class="btn-group dropdown">
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
              </button>
              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                <a class="dropdown-item" href="{{route('kategori.edit', $data->id_kategori)}}"> Edit </a>
                <form action="{{route('kategori.destroy', $data->id_kategori)}}" class="pull-left"  method="post">
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
<!-- End Datatables -->
@endsection