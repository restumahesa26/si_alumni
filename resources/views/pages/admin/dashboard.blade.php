@extends('layouts.admin')

@section('title')
    <title>Admin | Dashboard</title>
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, {{ Auth::user()->nama }}</h4>
                    <p class="mb-0">Selamat datang di Sistem Informasi Alumni Informatika UNIB</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user text-success border-success"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Alumni</div>
                            <div class="stat-digit">{{ $alumni }} Orang</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user text-primary border-primary"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Mahasiswa</div>
                            <div class="stat-digit">{{ $mahasiswa }} Orang</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-comments-smiley text-warning border-warning"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Diskusi</div>
                            <div class="stat-digit">{{ $diskusi }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-id-badge text-danger border-danger"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Loker</div>
                            <div class="stat-digit">{{ $loker }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-primary">
            <div class="panel-heading"><b>Grafik Lulusan Alumni</b></div>
            <div class="panel-body">
                <canvas id="canvas" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
    <script>
        var Years = ['2020','2021','2022'];
        var Labels = ['nksajfkasf','adjhajsd','adad'];
        var Prices = [{{ $cAlumni }},{{ $c2Alumni }}, {{ $c3Alumni }}];
        $(document).ready(function(){
            var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels:Years,
                      datasets: [{
                          label: 'Tahun',
                          data: Prices,
                          borderWidth: 1,
                          backgroundColor : [
                            "blue", 'blue'
                        ],
                      }]
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });
        });
        </script>

    @if ($message = Session::get('success-login'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat Datang',
            text: '{{ $message }}'
        })
    </script>
    @endif
@endpush
