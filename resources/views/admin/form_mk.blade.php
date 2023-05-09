@extends('layouts.master')
@section('title')
form input mk
@endsection
@section('content')
<form action="/matkul" method="post">
    @csrf
    <div class="bg-white p-5 rounded">
        <div class="form-group">
            <label for="exampleInputNamaMatkul">Nama Matkul</label>
            <input type="text" class="form-control" id="exampleInputNamaMatkul" placeholder="Enter Nama Matkul" name="nama_mk">
        </div>
        <div class="form-group">
            <label for="exampleInputNamaDosen">Nama Dosen</label>
            <input type="text" class="form-control" id="exampleInputNamaDosen" placeholder="Enter Nama Dosen" name="dosen_mk">
        </div>
        <div class="form-group">
            <label for="exampleInputRuangMatkul">Ruang Matkul</label>
            <input type="text" class="form-control" id="exampleInputRuangMatkul" placeholder="Enter Ruang Matkul" name="ruang_mk">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
  </form>
@endsection