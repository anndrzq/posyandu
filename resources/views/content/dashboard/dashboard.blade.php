@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    @if (session('success'))
        <div class="flash-data" data-flashdata="{{ session('success') }}"></div>
    @endif

    @if (session('error'))
        <div class="error-data" data-errordata="{{ session('error') }}"></div>
    @endif
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalAdmin }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fa-solid fa-person-breastfeeding"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Keluarga</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalUser }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Petugas</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalOfficer }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fa-solid fa-user-nurse"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Bidan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalMidwife }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Total Immunisasi Harian</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Total Penimbangan Harian</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script>
        var dailyTotalsY = @json($dailyTotalsY);
        var dailyTotalsT = @json($dailyTotalsT);
        var sortedDates = Object.keys(dailyTotalsY).sort(function(a, b) {
            return new Date(b) - new Date(a);
        });
        var formattedDates = sortedDates.map(function(date) {
            return moment(date).format('DD MMMM YYYY');
        });
        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: formattedDates,
                datasets: [{
                    label: 'Sukses Di Imunisasi',
                    data: sortedDates.map(function(date) {
                        return dailyTotalsY[date];
                    }),
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }, {
                    label: 'Tidak Bisa Di Imunisasi',
                    data: sortedDates.map(function(date) {
                        return dailyTotalsT[date];
                    }),
                    backgroundColor: '#ef6777',
                    borderColor: '#ef6777',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: true
                        }
                    }]
                },
            }
        });
    </script>


    <script>
        var TotalsWeighingY = @json($TotalsWeighingY);
        var TotalsWeighingT = @json($TotalsWeighingT);
        var sortedDates = Object.keys(TotalsWeighingY).sort(function(a, b) {
            return new Date(b) - new Date(a);
        });
        var formattedDates = sortedDates.map(function(date) {
            return moment(date).format('DD MMMM YYYY');
        });
        var ctx = document.getElementById("myChart3").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: formattedDates,
                datasets: [{
                    label: 'Sesuai',
                    data: sortedDates.map(function(date) {
                        return TotalsWeighingY[date];
                    }),
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }, {
                    label: 'Tidak Sesuai',
                    data: sortedDates.map(function(date) {
                        return TotalsWeighingT[date];
                    }),
                    backgroundColor: '#ef6777',
                    borderColor: '#ef6777',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: true
                        }
                    }]
                },
            }
        });
    </script>
@endpush
