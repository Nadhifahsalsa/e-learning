@extends('layouts.master')
@section('title')
Dashboard
@endsection
@section('content')
    @php
      // dd($charts)   
    @endphp
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Konsep Jaringan</p>
                <p class="mb-0">
                  <br><span class="text-success text-sm font-weight-bolder">Selasa</span>
                  <br>15.30-17.10
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Basis Data Lanjut</p>
                <p class="mb-0">
                  <br><span class="text-success text-sm font-weight-bolder">Selasa</span>
                  <br>8.00-9.40
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Metodologi Agile</p>
                <p class="mb-0">
                  <br><span class="text-success text-sm font-weight-bolder">Kamis</span>
                  <br>8.50-10.30
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Sistem Pendukung Keputusan</p>
                <p class="mb-0">
                  <br><span class="text-success text-sm font-weight-bolder">Rabu</span>
                  <br>11.20-13.00
                </p>
              </div>
          </div>
        </div>
      </div>
    </div>
    <p>
      
  </div>
  
  
  <div class="row mt-4">
      <div class="card z-index-2 h-100">
        
        <div class="card-body p-3">
            <canvas id="myChart" width="100%"></canvas>
        </div>
      </div>

      @foreach ($siswa as $siswa)
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-3">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ $siswa->name }}</p>
                <a href="/pdf/{{ $siswa->id }}" class="brn ">Download PDF</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
    
  </div>
  
    
    </div>

  @push('chart')
  <script>
    $(document).ready(function(){
      (function() {
        const data = {{ Js::from($charts['data']) }};

        new Chart(
            document.getElementById('myChart'),
            {
            type: 'bar',
            data: {
                labels: {{ Js::from($charts['labels']) }},
                datasets: [
                {
                    label: 'Rekap by year',
                    data: data
                }
                ]
            }
            }
        );
        })();
        })
  </script>
  @endpush

@endsection
