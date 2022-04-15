@extends('Templates.template')
@section('title','Login')
@section('content')
<div class="container mt-3">
<form action="{{route('admin.saveTanggapan',$data->id)}}" method="post">
    @csrf
        <div class="mb-3">
            <label for="keluhan" class="form-label">Tanggapan Admin</label>
            <input type="text" class="form-control"  id="tanggapan" name="tanggapan">
        </div>
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <input type="hidden" class="form-control" value="{{$data->id_user}}" readonly id="id_user" name="id_user">
            <input type="text" class="form-control" value="{{$data->keluhan}}"  readonly id="keluhan" name="keluhan">
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Pengajuan</label>
            <input type="date" class="form-control" value="{{$data->Tanggal_Pengajuan}}" readonly id="tanggal" name="tanggal">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
   
@endsection