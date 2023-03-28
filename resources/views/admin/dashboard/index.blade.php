@extends('admin.layout.layout')
@section('content')
    @php
        $d[1] = [
            'url' => URL('/users'),
            'title' => 'users',
        ];
        $d[2] = [
            'url' => URL('/users'),
            'title' => 'companias',
        ];
    @endphp
    {{-- @component('breadcumb', ['data' => $d]) @endcomponent --}}

    <x-breadcumb :data="$d"></x-breadcumb>
    <div class="row">
        <div class="col-6 col-sm-6 col-md-3">
            <x-card-count color="#bbbb88" title="Ultimas fotos" count="10"><i class="fa-solid fa-photo-film fa-3x"></i>
            </x-card-count>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <x-card-count color="#80273d" title="Visitas" count="150"><i class="fa-solid fa-eye fa-3x"></i></x-card-count>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <x-card-count color="#ccc68d" title="Descargas" count="100"><i class="fa-solid fa-file-arrow-down fa-3x"></i>
            </x-card-count>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 col-sm-12 col-md-4">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
