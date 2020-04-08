"use strict";
        var equiposPorOrganosDesconcentrados = (url) => {
            ajaxRequest(
                    url,
                    'POST',
                    {},
                    function(response){
                        Highcharts.chart('equiposPorOrganosDesconcentrados', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Equipos por Órganos Desconcentrados'
                            },
                            xAxis: {
                                categories: response["categories"]
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Total de Equipos'
                                },
                                stackLabels: {
                                    enabled: true,
                                    style: {
                                        fontWeight: 'bold',
                                        color: ( // theme
                                            Highcharts.defaultOptions.title.style &&
                                            Highcharts.defaultOptions.title.style.color
                                        ) || 'gray'
                                    }
                                }
                            },
                            legend: {
                                align: 'right',
                                x: -30,
                                verticalAlign: 'top',
                                y: 25,
                                floating: true,
                                backgroundColor:
                                    Highcharts.defaultOptions.legend.backgroundColor || 'white',
                                borderColor: '#CCC',
                                borderWidth: 1,
                                shadow: false
                            },
                            tooltip: {
                                headerFormat: '<b>{point.x}</b><br/>',
                                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            series: response["series"]
                        });

                });
        };



        var equiposPorTipo = (url) => {
            console.log(url)
            ajaxRequest(
                    url,
                    'POST',
                    {},
                    function(response){

                        Highcharts.chart('equiposPorTipo', {
                        chart: {
                            type: 'pie',
                            plotShadow: false,
                        },
                        credits: {
                            enabled: false
                        },
                        plotOptions: {
                            pie: {
                                innerSize: '70%',
                                borderWidth: 6,
                                borderColor: null,
                                slicedOffset: 0,
                                dataLabels: {
                                    connectorWidth: 0
                                }
                            }
                        },
                        title: {
                            text: "Cantidad de equipos por Tipo"
                        },
                        subtitle: {
                            verticalAlign: 'middle',
                            floating: true,
                            text: response["total"],
                            style: {
                                fontSize: '40px'
                             }
                        },
                        legend: {
                        },
                        series:[{
                            id: "Tipo",
                            name: "Cantidad",
                            data :response["data"]
                        }]
                        });
                }
            );
        }
