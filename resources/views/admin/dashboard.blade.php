@extends('Templates.template')
@section('title','Dashboard Admin')
@section('content')
<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama User</th>
      <th scope="col">Keluhan</th>
      <th scope="col">Tanggal Pengajuan</th>
      <th scope="col">Tanggapan Admin</th>
      @if(auth()->user())
        <th scope="col">Action</th>
      @endif
    </tr>
  </thead>
  <tbody>
      @foreach($data as $datas)
        <tr>
            <th scope="row">{{$loop->index+1+($data->currentPage()-1)*5}}</th>
            <td>{{$datas->name}}</td>
            <td>{{$datas->keluhan}}</td>
            <td>{{$datas->Tanggal_Pengajuan}}</td>
            <td>{{$datas->tanggapan_admin}}</td>
            @if(auth()->user())
            <td>
                <div class="btn-group" role="group" aria-label="Basic example" >
                    @csrf
                    <a type="button" class="btn btn-outline-secondary" href="{{route('admin.tanggapiKeluhan',$datas->id)}}">Tanggapi</a>
                    <!-- <a type="button" class="btn btn-success" href="{{route('user.EditKeluhan',$datas->id)}}">Edit</button> -->
                </div>
                <div class="btn-group" role="group" aria-label="Basic example" >
                    @csrf
                    <a type="button" class="btn btn-outline-secondary" href="{{route('admin.EditKeluhan',$datas->id)}}">Edit</a>
                    <!-- <a type="button" class="btn btn-success" href="{{route('user.EditKeluhan',$datas->id)}}">Edit</button> -->
                </div>
                <form action="{{route('admin.deleteKeluhan',$datas->id)}}" method="post" class='d-inline' onsubmit="return confirm('Yakin Hapus Tanggapan ?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form> 
             </td>
            @endif
        </tr>
      @endforeach
  </tbody>
</table>
<div class="mt-4 text-center">
    showing 
    {{$data->firstItem()}}
    to 
    {{$data->lastItem()}}
</div>
{{$data->links()}}
@endsection