import './app';
import Highcharts from "highcharts";
import Exporting from 'highcharts/modules/exporting';
import ExportData from 'highcharts/modules/export-data';
import Accessibility from 'highcharts/modules/accessibility';
// Initialize accessibility module. (CommonJS only)
Accessibility(Highcharts);
// Initialize exporting module. (CommonJS only)
Exporting(Highcharts);
// Initialize export-data module. (CommonJS only)
ExportData(Highcharts)
window.Highcharts = Highcharts;

$(function(){
    Echo.channel('nuevo-juego')
            .listen('NewJuegoEvent', (e) => {
                G0();G1();G2();G3();//G4();
    });
    //Grafico0
    function G0(){
        $.getJSON("informe/grafico/0",function(data){
            if(data != ""){
                Highcharts.chart('container0', {
                    chart: {
                        type: 'column',
                        styledMode: false
                    },
                    title: {
                        text: 'Aciertos, Desaciertos, Tiempo agotado y Turnos perdidos',
                        align: 'left'
                    },
                    subtitle: {
                        text: 'Source',
                        align: 'left'
                    },
                    xAxis: {
                        categories: data['categories'] //Equipos
                    },
                    yAxis: [{ // Primary axis
                        className: 'highcharts-color-0',
                        title: {
                            text: 'Valores'
                        },
                        tickInterval:1
                    }],
                    plotOptions: {
                        column: {
                            borderRadius: 5
                        }
                    },
                    series: data['series']
                });
            }else{
                $("div#container0").addClass('alert alert-warning').html('Esperando que inicie el juego');
            }
        });
    }
    //Grafico1
    function G1(){
        $.getJSON("informe/grafico/1",function(data){
            if(data != ""){
                Highcharts.chart('container1', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        align: 'left',
                        text: 'Situación del juego'
                    },
                    subtitle: {
                        align: 'left',
                        text: 'Puntuaciones por equipos participantes'
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Sumatoria del puntaje alcanzado entre ambos equipos'
                        },
                        tickInterval:5
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.0f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
                    },

                    series: [
                        {
                            name: "Equipo",
                            colorByPoint: true,
                            data: data
                        }
                    ]
                });
            }else{
                $("div#container1").addClass('alert alert-warning').html('Esperando que inicie el juego');
            }
        });
    }
    //Grafico2
    function G2(){
        $.getJSON("informe/grafico/2",function(data){
            if(data != ""){
                Highcharts.chart('container2', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Porcentaje por puntaje de Equipos',
                        align: 'left'
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
                        name: 'Puntaje',
                        colorByPoint: true,
                        data: data
                    }]
                });
            }else{
                $("div#container2").addClass('alert alert-warning').html('Esperando que inicie el juego');
            }
        });
    }
    //grafico3
    function G3(){
        $.getJSON("informe/grafico/3",function(data){
            if(data != ""){
                Highcharts.chart('container3', {
                    chart: {
                        type: 'spline'
                    },
                    title: {
                        text: 'Tiempos de respuesta en segundos'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        type: 'linear',
                        dateTimeLabelFormats: { // don't display the year
                            second: '%S'
                        },
                        title: {
                            text: 'Número de turnos consumidos por equipo'
                        },
                        tickInterval:1,
                        min:0
                    },
                    yAxis: {
                        title: {
                            text: 'Escala de tiempo en segundos (s)'
                        },
                        min: 0,
                        tickInterval:1
                    },
                    tooltip: {
                        headerFormat: '<b>{series.name}</b><br>',
                        pointFormat: '{point.y:.2f} s'
                    },

                    plotOptions: {
                        series: {
                            marker: {
                                enabled: true,
                                radius: 2.5
                            }
                        }
                    },

                    colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

                    // Define the data points. All series have a year of 1970/71 in order
                    // to be compared on the same x axis. Note that in JavaScript, months start
                    // at 0 for January, 1 for February etc.
                    series: data
                });
            }else{
                $("div#container3").addClass('alert alert-warning').html('Esperando que inicie el juego');
            }
        });
    }
    //grafico4
    /* function G4(){
        $.getJSON("informe/grafico/4",function(data){
            if(data != ""){
                Highcharts.chart('container4', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: 0,
                        plotShadow: false
                    },
                    title: {
                        text: 'Avance del Juego',
                        align: 'center',
                        verticalAlign: 'middle',
                        y: 60
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
                                distance: -50,
                                style: {
                                    fontWeight: 'bold',
                                    color: 'white'
                                },
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            },
                            showInLegend: true,
                            startAngle: -90,
                            endAngle: 90,
                            center: ['50%', '75%'],
                            size: '110%'
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Porcentaje',
                        innerSize: '50%',
                        data: data
                    }]
                });
            }else{
                $("div#container4").addClass('alert alert-warning').html('Esperando que inicie el juego');
            }
        });
    }*/
    G0();G1();G2();G3();//G4();
});
