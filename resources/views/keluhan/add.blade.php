@extends('Templates.template')
@section('title','Login')
@section('content')
<div class="container mt-3">
<form action="{{route('user.saveKeluhan')}}" method="post">
    @csrf
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <input type="text" class="form-control"  id="keluhan" name="keluhan">
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Pengajuan</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection