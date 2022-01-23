@extends('template.perusahaan.main')
@section('css')
<style>
    .highcharts-credits{
        display: none;
    }
</style>
@endsection
@section('content')
<div class="card card-custom min-h-lg-800px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Dashboard</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div id="GrafikProdukTerjual"></div>
                <br><br><br><br>
            </div>
            <div class="col-md-12">
                <div id="GrafikStokProduk"></div>
                <br><br><br><br>
            </div>
            <div class="col-md-12">
                <div id="GrafikLaporanPemasaran"></div>
            </div>
        </div>
        <br />
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        setGrafikProdukTerjual();
        setGrafikStokProduk();
        setGrafikLaporanPemasaran();
    });

    function setGrafikProdukTerjual()
    {
        $.get("{{ URL::to('grafik-produk-terjual') }}", function(res){
            var data = JSON.parse(res);
            // console.log(data);
            DefaultGrafikProdukTerjual(data);
        });
    }
    function setGrafikStokProduk()
    {
        $.get("{{ URL::to('grafik-stok-terjual') }}", function(res){
            var data = JSON.parse(res);
            // console.log(data);
            DefaultGrafikStokProduk(data);
        });
    }
    function setGrafikLaporanPemasaran()
    {
        $.get("{{ URL::to('grafik-laporan-pemasaran') }}", function(res){
            var data = JSON.parse(res);
            console.log(data);
            DefaultGrafikLaporanPemasaran(data);
        });
    }

    function DefaultGrafikProdukTerjual(data)
    {
        Highcharts.chart('GrafikProdukTerjual', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Produk Terjual Tahun '+data.tahun+''
            },
            subtitle: {
                text: ' '
            },
            xAxis: {
                categories: data.bulan,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (pcs)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f} pcs</b></td></tr>',
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
            series: data.series
        });
    }
    function DefaultGrafikStokProduk(data)
    {
        Highcharts.chart('GrafikStokProduk', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Stock Produk Tahun '+data.tahun+''
            },
            subtitle: {
                text: ' '
            },
            xAxis: {
                categories: data.bulan,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (pcs)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f} pcs</b></td></tr>',
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
            series: data.series
        });
    }
    function DefaultGrafikLaporanPemasaran(data)
    {
        Highcharts.chart('GrafikLaporanPemasaran', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Grafik Laporan Pemasaran '+data.tahun+''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: data.series
            }]
        });
    }
</script>
@endsection