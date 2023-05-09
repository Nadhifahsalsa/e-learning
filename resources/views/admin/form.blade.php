@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<form action="/tugas" method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Id Siswa</label>
      <input type="text" name="id_siswa" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter ID Siswa">
    </div>
    <div class="form-group">
      <input type="hidden" name="id_dosen" value="{{auth()->user()->id}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Nama Tugas</label>
      <input type="text" name="nama" class="form-control" id="exampleInputPassword1" placeholder="Mata Kuliah">
    </div>
    <div class="form-group">
      <label for="Deskripsi">Deskripsi</label>
      <input name="deskripsi" class="form-control"></input>
    </div>
    <div class="form-group">
      <label for="date">DeadLine</label>
      <input name="date" class="form-control" type="date"></input>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection