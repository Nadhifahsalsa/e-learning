@extends('layouts.master')
@section('title')
Mata Kuliah
@endsection
@section('content')
@forelse ($data as $item)
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ $item->nama_mk }}</p>
            <p class="mb-0">
              <br><span class="text-success text-sm font-weight-bolder">{{ $item->hari }}</span>
              <br>{{ $item->pukul }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@empty
    
@endforelse
  <div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        
        {{-- <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
          </div>
        </div> --}}
      </div>
    </div>
    
  </div>
  
    
    </div>
@endsection