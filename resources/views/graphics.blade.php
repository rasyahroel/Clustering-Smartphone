@extends('layouts.main')

@section('content')
    <div class="card mb-5 shadow">
        <div id="chart"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            series: [{
                name: "Klustering",
                data: [
                    @foreach ($data as $key => $graph)
                        [{{ $key + 1 }}, {{ round($graph, 3) }}],
                    @endforeach

                ]
            }],
            chart: {
                height: 350,
                type: 'scatter',
                zoom: {
                    enabled: true,
                    type: 'xy'
                }
            },
            yaxis: {
                tickAmount: 7
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection
