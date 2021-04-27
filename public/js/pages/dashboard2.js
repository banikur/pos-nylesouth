//[Dashboard Javascript]

//Project:	Minimalelite Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function() {

    'use strict';

    //------------echarts2	



    // if ($('#e_chart_2').length > 0) {
    //     var eChart_2 = echarts.init(document.getElementById('e_chart_2'));
    //     var option = {
    //         color: ['#6F88EE', '#21ACE3', '#D071E3', '#F13A2E'],
    //         tooltip: {
    //             trigger: 'axis',
    //             backgroundColor: 'rgba(33,33,33,1)',
    //             borderRadius: 0,
    //             padding: 10,
    //             axisPointer: {
    //                 type: 'cross',
    //                 label: {
    //                     backgroundColor: 'rgba(33,33,33,1)'
    //                 }
    //             },
    //             textStyle: {
    //                 color: '#fff',
    //                 fontStyle: 'normal',
    //                 fontWeight: 'normal',
    //                 fontFamily: "'Nunito Sans', sans-serif",
    //                 fontSize: 12
    //             }
    //         },
    //         toolbox: {
    //             show: true,
    //             orient: 'vertical',
    //             left: 'right',
    //             top: 'center',
    //             showTitle: false,
    //             feature: {
    //                 mark: {
    //                     show: true
    //                 },
    //                 magicType: {
    //                     show: true,
    //                     type: ['line', 'bar', 'stack', 'tiled']
    //                 },
    //                 restore: {
    //                     show: true
    //                 },
    //             }
    //         },
    //         grid: {
    //             left: '1%',
    //             right: '10%',
    //             bottom: '5%',
    //             top: '1%',
    //             containLabel: true
    //         },
    //         xAxis: [{
    //             type: 'category',
    //             data: ['FB', 'TW', 'G+', 'INSTA', 'IN', 'BE'],
    //             axisLine: {
    //                 show: false
    //             },
    //             axisLabel: {
    //                 textStyle: {
    //                     color: '#878787'
    //                 }
    //             },
    //         }],
    //         yAxis: [{
    //             type: 'value',
    //             axisLine: {
    //                 show: false
    //             },
    //             axisLabel: {
    //                 textStyle: {
    //                     color: '#878787'
    //                 }
    //             },
    //             splitLine: {
    //                 show: false,
    //             }
    //         }],
    //         series: [{
    //                 name: 'Active',
    //                 type: 'bar',
    //                 data: [485, 545, 412, 512, 398, 474]
    //             },
    //             {
    //                 name: 'Closed',
    //                 type: 'bar',
    //                 stack: 'st1',
    //                 data: [210, 102, 159, 200, 158, 48]
    //             },
    //             {
    //                 name: 'Hold',
    //                 type: 'bar',
    //                 stack: 'st1',
    //                 data: [248, 248, 154, 235, 128, 325]
    //             },
    //             {
    //                 name: 'Pending',
    //                 type: 'bar',
    //                 stack: 'st1',
    //                 data: [154, 125, 254, 189, 245, 342]
    //             }
    //         ]
    //     };

    //     eChart_2.setOption(option);
    //     eChart_2.resize();
    // }



    // Morris-chart

    // Morris.Area({
    //     element: 'morris-area-chart',
    //     data: [{
    //             period: '2010',
    //             tv: 50,
    //             mobile: 80,
    //             laptop: 20
    //         }, {
    //             period: '2011',
    //             tv: 130,
    //             mobile: 100,
    //             laptop: 80
    //         }, {
    //             period: '2012',
    //             tv: 80,
    //             mobile: 60,
    //             laptop: 70
    //         }, {
    //             period: '2013',
    //             tv: 70,
    //             mobile: 200,
    //             laptop: 140
    //         }, {
    //             period: '2014',
    //             tv: 180,
    //             mobile: 150,
    //             laptop: 140
    //         }, {
    //             period: '2015',
    //             tv: 105,
    //             mobile: 100,
    //             laptop: 80
    //         },
    //         {
    //             period: '2016',
    //             tv: 250,
    //             mobile: 150,
    //             laptop: 200
    //         }
    //     ],
    //     xkey: 'period',
    //     ykeys: ['tv', 'mobile', 'laptop'],
    //     labels: ['TV', 'Mobile', 'Laptop'],
    //     pointSize: 3,
    //     fillOpacity: 0.1,
    //     pointStrokeColors: ['#ba69aa', '#69cce0', '#ef483e'],
    //     behaveLikeLine: true,
    //     gridLineColor: '#e0e0e0',
    //     lineWidth: 3,
    //     hideHover: 'auto',
    //     lineColors: ['#ba69aa', '#69cce0', '#ef483e'],
    //     resize: true

    // });


    // if ($('#e_chart_3').length > 0) {
    //     var eChart_3 = echarts.init(document.getElementById('e_chart_3'));
    //     var option3 = {
    //         series: [{
    //             type: 'liquidFill',
    //             data: [0.5, 0.4],
    //             radius: '100%',
    //             shape: 'circle',
    //             color: ['#0bb2d4', '#7231F5'],
    //             backgroundStyle: {
    //                 borderWidth: 0,
    //                 color: 'rgba(255,255,255,0)',
    //                 shadowBlur: 0
    //             },
    //             itemStyle: {
    //                 normal: {
    //                     shadowBlur: 5,
    //                     shadowColor: 'rgba(0, 0, 0, .5)'
    //                 }
    //             },
    //             outline: {
    //                 borderDistance: 1,
    //                 itemStyle: {
    //                     borderWidth: 0,
    //                     borderColor: '#fff',
    //                     shadowBlur: 0,
    //                 }
    //             },
    //             label: {
    //                 normal: {
    //                     fontSize: 10
    //                 }
    //             }
    //         }]
    //     };
    //     eChart_3.setOption(option3);
    //     eChart_3.resize();
    // }


    var options = {
        chart: {
            height: 357,
            type: 'line',
        },
        stroke: {
            curve: 'smooth'
        },

        series: [{
            name: 'Online',
            type: 'area',
            data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33]
        }, {
            name: 'Store',
            type: 'line',
            data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43]
        }],
        fill: {
            type: 'solid',
            opacity: [0.35, 1],
        },
        labels: ['Dec 01', 'Dec 02', 'Dec 03', 'Dec 04', 'Dec 05', 'Dec 06', 'Dec 07', 'Dec 08', 'Dec 09 ', 'Dec 10', 'Dec 11'],
        markers: {
            size: 0
        },
        colors: ['#faa700', '#E6155E'],
        yaxis: [{
                title: {
                    text: 'Online',
                },
            },
            {
                opposite: true,
                title: {
                    text: 'Store',
                },
            },
        ],
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " points";
                    }
                    return y;

                }
            }
        }

    }

    var chart = new ApexCharts(
        document.querySelector("#chart-s4"),
        options
    );

    chart.render();


    window.Apex = {
        stroke: {
            width: 3
        },
        markers: {
            size: 0
        },
        tooltip: {
            theme: 'dark',
        }
    };

    var randomizeArray = function(arg) {
        var array = arg.slice();
        var currentIndex = array.length,
            temporaryValue, randomIndex;

        while (0 !== currentIndex) {

            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    }

    // data for the sparklines that appear below header area
    var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];

    var spark1 = {
        chart: {
            id: 'spark1',
            group: 'sparks',
            type: 'line',
            height: 160,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                opacity: 0.2,
            }
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 0
        },
        grid: {
            padding: {
                top: 10,
                bottom: 10,
                left: 0
            }
        },
        colors: ['#fff'],
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }
    }

    var spark2 = {
        chart: {
            id: 'spark2',
            group: 'sparks',
            type: 'line',
            height: 160,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                opacity: 0.2,
            }
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        stroke: {
            curve: 'smooth'
        },
        grid: {
            padding: {
                top: 10,
                bottom: 10,
                left: 0
            }
        },
        markers: {
            size: 0
        },
        colors: ['#fff'],
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }
    }

    var spark3 = {
        chart: {
            id: 'spark3',
            group: 'sparks',
            type: 'line',
            height: 160,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                opacity: 0.2,
            }
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 0
        },
        grid: {
            padding: {
                top: 10,
                bottom: 10,
                left: 0
            }
        },
        colors: ['#fff'],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }
    }

    var spark4 = {
        chart: {
            id: 'spark4',
            group: 'sparks',
            type: 'line',
            height: 160,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                opacity: 0.2,
            }
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 0
        },
        grid: {
            padding: {
                top: 10,
                bottom: 10,
                left: 0
            }
        },
        colors: ['#fff'],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }
    }

    var spark5 = {
        chart: {
            id: 'spark5',
            group: 'sparks',
            type: 'line',
            height: 160,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                opacity: 0.2,
            }
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 0
        },
        grid: {
            padding: {
                top: 10,
                bottom: 10,
                left: 0
            }
        },
        colors: ['#fff'],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }
    }    

    var spark6 = {
        chart: {
            id: 'spark6',
            group: 'sparks',
            type: 'line',
            height: 160,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                opacity: 0.2,
            }
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 0
        },
        grid: {
            padding: {
                top: 10,
                bottom: 10,
                left: 0
            }
        },
        colors: ['#fff'],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }
    }   
    
    var spark7 = {
        chart: {
            id: 'spark7',
            group: 'sparks',
            type: 'line',
            height: 160,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                opacity: 0.2,
            }
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 0
        },
        grid: {
            padding: {
                top: 10,
                bottom: 10,
                left: 0
            }
        },
        colors: ['#fc4b6c'],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }
    }   
    
    var spark8 = {
        chart: {
            id: 'spark8',
            group: 'sparks',
            type: 'line',
            height: 160,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                opacity: 0.2,
            }
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 0
        },
        grid: {
            padding: {
                top: 10,
                bottom: 10,
                left: 0
            }
        },
        colors: ['#fc4b6c'],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        }
    }      

    new ApexCharts(document.querySelector("#spark1"), spark1).render();
    new ApexCharts(document.querySelector("#spark2"), spark2).render();
    new ApexCharts(document.querySelector("#spark3"), spark3).render();
    new ApexCharts(document.querySelector("#spark4"), spark4).render();
    new ApexCharts(document.querySelector("#spark5"), spark5).render();
    new ApexCharts(document.querySelector("#spark6"), spark6).render();
    new ApexCharts(document.querySelector("#spark7"), spark7).render();
    new ApexCharts(document.querySelector("#spark8"), spark8).render();


}); // End of use strict