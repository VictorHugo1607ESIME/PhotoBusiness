@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-6 col-sm-6 col-md-3">
            <div class="card  text-white card-height" style="background-color:#eeaa88">
                <div class="card-body text-white">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-white">10</h4>
                        </div>
                        <div class="col-6 text-right icono">
                            <i class="fa-solid fa-photo-film fa-3x"></i>
                        </div>
                        <div class="col-12">
                            <h6 class="card-title text-white">Fotos Nuevas</h6>
                        </div>
                        <div class="col-12">
                            <a href="" class="card-link text-dark">Ver <i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <div class="card  text-white card-height" style="background-color:#bbbb88">
                <div class="card-body text-white">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-white">150</h4>
                        </div>
                        <div class="col-6 text-right icono">
                            <i class="fa-solid fa-eye fa-3x"></i>
                        </div>
                        <div class="col-12">
                            <h6 class="card-title text-white">Visitas</h6>
                        </div>
                        <div class="col-12">
                            <a href="" class="card-link text-dark">Ver <i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <div class="card  text-white card-height" style="background-color:#ccc68d">
                <div class="card-body text-white">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-white">5</h4>
                        </div>
                        <div class="col-6 text-right icono">
                            <i class="fa-solid fa-file-arrow-down fa-3x"></i>
                        </div>
                        <div class="col-12">
                            <h6 class="card-title text-white">Descargas</h6>
                        </div>
                        <div class="col-12">
                            <a href="" class="card-link text-dark">Ver <i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
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
