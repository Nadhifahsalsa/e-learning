@extends('layouts.master')
@section('title')
Tugas Kuliah
@endsection
@section('content')
@if (auth()->user()->role == 'dosen')
        <a href="/tugas" class="btn btn-success">Tambah Tugas</a>
    @else
        
    @endif
<div class="card">
    <div class="card-header pb-0 px-3">
      <h6 class="mb-0">Tugas Anda</h6>
    </div>
    <div class="card-body pt-4 p-3">
      <ul class="list-group">
        @forelse ($tugas as $item)
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">{{ $item->nama_tugas }}</h6>
                  <span class="mb-2 text-xs">Desc: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->deskripsi }}</span></span>
                    <form action="/tugas/edit/{{ $item->id }}" method="POST" id="{{ $item->id }}">
                      @csrf
                      @method('PUT')
                      <input type="date" name="deadline" class="form-control" value="{{ $item->deadline }}" onchange="update('{{ $item->id }}');">
                      <input type="text" name="nilai" class="form-control" value="{{ $item->nilai }}" onchange="update('{{ $item->id }}');" placeholder="Nilai" hidden>
                    </form>
                </div>
                <div class="ms-auto text-end">
                  @if ($item->tugas != 'kosong')
                  <a class="btn btn-link text-success text-gradient px-3 mb-0" href="javascript:;">Sudah Dikerjakan</a>
                  <a href="{{ route('deleteTugas', ['id'=>$item->id]) }}" class="btn btn-link text-danger px-3 mb-0">Delete</a>
                  <form action="/tugas/edit/{{ $item->id }}" method="POST" id="k{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    @if (auth()->user()->role == 'siswa')
                    <input type="text" name="nilai" class="form-control" value="{{ $item->nilai }}" onchange="update('k{{ $item->id }}');" placeholder="Nilai" readonly>
                    @else
                      <input type="text" name="nilai" class="form-control" value="{{ $item->nilai }}" onchange="update('k{{ $item->id }}');" placeholder="Nilai">
                    @endif
                    
                    <input type="date" name="deadline" class="form-control" value="{{ $item->deadline }}" onchange="update('k{{ $item->id }}');" hidden>
                  </form>
                  @else
                  <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;">Belum Dikerjakan</a>
                  <a href="{{ route('deleteTugas', ['id'=>$item->id]) }}" class="btn btn-link text-danger px-3 mb-0">Delete</a>
                  <form action="/submit/{{ $item->id }}" method="post" enctype= multipart/form-data>
                    @csrf
                    @method('PUT')
                    <input type="file" name="tugas" id="" class="btn btn-link text-dark px-3 mb-0 form-control">
                    <input type="submit" value="Kumpulkan" class="btn">
                  </form>
                  @endif
                </div>
            </li>
        @empty
            
        @endforelse
        @if (auth()->user()->role == 'dosen')
        @forelse ($tugasdosen as $item)
        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
            <div class="d-flex flex-column">
              <h6 class="mb-3 text-sm">{{ $item->nama_tugas }}</h6>
              <span class="mb-2 text-xs">Desc: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->deskripsi }}</span></span>
                <form action="/tugas/edit/{{ $item->id }}" method="POST" id="{{ $item->id }}">
                  @csrf
                  @method('PUT')
                  <input type="date" name="deadline" class="form-control" value="{{ $item->deadline }}" onchange="update('{{ $item->id }}');">
                  <input type="text" name="nilai" class="form-control" value="{{ $item->nilai }}" onchange="update('{{ $item->id }}');" placeholder="Nilai" hidden>
                </form>
            </div>
            <div class="ms-auto text-end">
              @if ($item->tugas != 'kosong')
              <a class="btn btn-link text-success text-gradient px-3 mb-0" href="javascript:;">Sudah Dikerjakan</a>
              <a href="{{ route('deleteTugas', ['id'=>$item->id]) }}" class="btn btn-link text-danger px-3 mb-0">Delete</a>
              <form action="/tugas/edit/{{ $item->id }}" method="POST" id="k{{ $item->id }}">
                @csrf
                @method('PUT')
                @if (auth()->user()->role == 'siswa')
                <input type="text" name="nilai" class="form-control" value="{{ $item->nilai }}" onchange="update('k{{ $item->id }}');" placeholder="Nilai" readonly>
                @else
                  <input type="text" name="nilai" class="form-control" value="{{ $item->nilai }}" onchange="update('k{{ $item->id }}');" placeholder="Nilai">
                @endif
                
                <input type="date" name="deadline" class="form-control" value="{{ $item->deadline }}" onchange="update('k{{ $item->id }}');" hidden>
              </form>
              @else
              <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;">Belum Mengumpulkan</a>
              <a href="{{ route('deleteTugas', ['id'=>$item->id]) }}" class="btn btn-link text-danger px-3 mb-0">Delete</a>
              {{-- <form action="/submit/{{ $item->id }}" method="post" enctype= multipart/form-data>
                @csrf
                @method('PUT')
                <input type="file" name="tugas" id="" class="btn btn-link text-dark px-3 mb-0 form-control">
                <input type="submit" value="Kumpulkan" class="btn">
              </form> --}}
              @endif
            </div>
        </li>
    @empty
        
    @endforelse
        @endif
      </ul>
    </div>
  </div>
  <script>
    function deadline(e){
      window.alert(e.target.value);
      console.log('BERHASIL');
      document.getElementById('updateDeadline').submit();
    }
  </script>
@endsection