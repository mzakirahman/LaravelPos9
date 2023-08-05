@extends('layout.main')

@section('judul')
    Halaman Dashboard
@endsection

@section('isi')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Media Online</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    {{ $jumlahPesananInfotorial }} <!-- Ganti dengan variabel dan tag yang berisi jumlah pesanan untuk Infotorial -->
                                </h1>
                                <div class="mb-0">
                                    <span class="text-muted">Jumlah Pesanan</span> <!-- Ganti dengan label yang sesuai -->
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Media Cetak Harian </h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    {{ $jumlahPesananHarian }} <!-- Ganti dengan variabel dan tag yang berisi jumlah pesanan untuk Infotorial -->
                                </h1>
                                <div class="mb-0">
                                    <span class="text-muted">Jumlah Pesanan</span> <!-- Ganti dengan label yang sesuai -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Media Cetak Mingguan</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    {{ $jumlahPesananMingguan }} <!-- Ganti dengan variabel dan tag yang berisi jumlah pesanan untuk Infotorial -->
                                </h1>
                                <div class="mb-0">
                                    <span class="text-muted">Jumlah Pesanan</span> <!-- Ganti dengan label yang sesuai -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Media Radio</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    {{ $jumlahPesananRadio }} <!-- Ganti dengan variabel dan tag yang berisi jumlah pesanan untuk Infotorial -->
                                </h1>
                                <div class="mb-0">
                                    <span class="text-muted">Jumlah Pesanan</span> <!-- Ganti dengan label yang sesuai -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Media Tv</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    {{ $jumlahPesananTv }} <!-- Ganti dengan variabel dan tag yang berisi jumlah pesanan untuk Infotorial -->
                                </h1>
                                <div class="mb-0">
                                    <span class="text-muted">Jumlah Pesanan</span> <!-- Ganti dengan label yang sesuai -->
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End of additional three boxes -->
            </div>
        </div>
    </div>
</main>
<div class="panel">
    <div id="chartharga">
    </div>
</div>

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    var categories = @json($dates); // Get the dates for the X-axis
    var data = @json($chartData);

    Highcharts.chart('chartharga', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rekapan Pemesanan Media',
            align: 'left'
        },
        xAxis: {
            categories: categories, // Use the dates for the X-axis
            crosshair: true,
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Pesanan'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'Online',
                data: data['Infotorial']
            },
            {
                name: 'Harian',
                data: data['Harian']
            },
            {
                name: 'Mingguan',
                data: data['Mingguan']
            },
            {
                name: 'Radio',
                data: data['Radio']
            },
            {
                name: 'Tv',
                data: data['Tv']
            },
            
        ]
    });
</script>
@endsection

@endsection