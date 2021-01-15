<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Toko Semi Joyo</h1>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pendapatan Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total_pendapatan_bulan_ini->total_pendapatan_bulan_ini, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pendapatan Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp. <?= number_format($total_pendapatan->total_pendapatan, 0, ',', '.')  ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Transaksi Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_transaksi->total_transaksi  ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Hutang Belum Dibayar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($hutang->jumlah_hutang, 0, ',', '.')  ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-address-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Bulanan Selama Tahun <?= date('Y') ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="chart-area">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Highcharts.chart('chart-area', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pendapatan Bulanan Toko Pakan Semi Joyo '
            },
            subtitle: {
                text: 'Tahun <?= date('Y') ?>'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Pendapatan Bulanan'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            colors: ['#1CC88A'],
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Pendapatan',
                data: [<?= $month['januari']->total_harga ?>, <?= $month['februari']->total_harga ?>, <?= $month['maret']->total_harga ?>, <?= $month['april']->total_harga ?>, <?= $month['mei']->total_harga ?>, <?= $month['juni']->total_harga ?>, <?= $month['juli']->total_harga ?>, <?= $month['agustus']->total_harga ?>, <?= $month['september']->total_harga ?>, <?= $month['oktober']->total_harga ?>, <?= $month['november']->total_harga ?>, <?= $month['desember']->total_harga ?>]
            }]
        });
    });
</script>