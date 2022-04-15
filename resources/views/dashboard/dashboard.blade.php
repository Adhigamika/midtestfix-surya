@extends('Templates.templated')
@section('title','Login')
@section('content')

@if(Auth::guard('web'))
    <div class="text-end upgrade-bt mr-5 mb-3 mt-3">
        <a href="{{ route('user.addKeluhan') }}" class="btn btn-success">Ajukan Keluhan</a>
    </div>
@endif

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
                    <a type="button" class="btn btn-outline-secondary" href="{{route('user.EditKeluhan',$datas->id)}}">Edit</a>
                    <!-- <a type="button" class="btn btn-success" href="{{route('user.EditKeluhan',$datas->id)}}">Edit</button> -->
                </div>
                <form action="{{route('user.deleteKeluhan',$datas->id)}}" method="post" class='d-inline' onsubmit="return confirm('apakah kamu yakin ingin menghapus keluhan ini ?')">
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