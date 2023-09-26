@extends('admin.layout.app2')
@section('css')
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div id="visit"></div>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <div>
            <x-card-count color="#F39C12" title="Imagenes totales" count="{{ $result['count_images'] }}"><i
                    class="fa-solid fa-image fa-5x"></i></x-card-count>
        </div>
        <div>
            <x-card-count color="#3498DB" title="Albums totales" count="{{ $result['count_albums'] }}"><i
                    class="fa-solid fa-folder fa-5x"></i></x-card-count>
        </div>

        <div>
            <x-card-count color="#E74C3C" title="Usuarios registrados" count="{{ $result['count_users'] }}"><i
                    class="fa-solid fa-user fa-5x"></i></x-card-count>
        </div>
        <div>
            <x-card-count color="#BDC3C7" title="Albums exclusivos" count="{{ $result['count_exclusive'] }}"><i
                    class="fa-solid fa-folder-plus fa-5x"></i></x-card-count>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var options = {
            series: [{
                name: "Visitas",
                data: @js($result['visit_count'])
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Visitas de los ultimos 7 días',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @js($result['visit_date']),
            }
        };

        var chart = new ApexCharts(document.querySelector("#visit"), options);
        chart.render();
    </script>
@endsection
