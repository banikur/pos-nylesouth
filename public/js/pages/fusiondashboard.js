const dataSource = {
    chart: {
      caption: "Realisasi Penerimaan Negara",
      subcaption: "2020",
      xaxisname: "Tahun",
      yaxisname: "Triliun Rupiah",
      formatnumberscale: "1",
      plottooltext:
        "<b>$dataValue</b> Triliun Rupiah <b>$seriesName</b> pada Bulan $label",
      theme: "fusion",
      drawcrossline: "1"
    },
    categories: [
      {
        category: [
          {
            label: "Januari"
          },
          {
            label: "Februari"
          },
          {
            label: "Maret"
          },
          {
            label: "April"
          },
          {
            label: "Mei"
          }
        ]
      }
    ],
    dataset: [
      {
        seriesname: "Deadrent",
        data: [
          {
            value: "125000"
          },
          {
            value: "300000"
          },
          {
            value: "480000"
          },
          {
            value: "800000"
          },
          {
            value: "1100000"
          }
        ]
      },
      {
        seriesname: "Royalty",
        data: [
          {
            value: "70000"
          },
          {
            value: "150000"
          },
          {
            value: "350000"
          },
          {
            value: "600000"
          },
          {
            value: "1400000"
          }
        ]
      },
      {
        seriesname: "Penjualan Hasil Tambang",
        data: [
          {
            value: "10000"
          },
          {
            value: "100000"
          },
          {
            value: "300000"
          },
          {
            value: "600000"
          },
          {
            value: "900000"
          }
        ]
      }
    ]
  };
  
  FusionCharts.ready(function() {
    var myChart = new FusionCharts({
      type: "mscolumn2d",
      renderAt: "penerimaan-negara",
      width: "100%",
      height: "100%",
      dataFormat: "json",
      dataSource
    }).render();
  });
  