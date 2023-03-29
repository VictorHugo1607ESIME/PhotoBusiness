<div>
    <div class="card  text-white card-height" style="background-color:{{ $color }}">
        <div class="card-body text-white">
            <div class="row">
                <div class="col-6">
                    <h4 class="text-white">{{ $count }}</h4>
                </div>
                <div class="col-6 text-right icono">
                    {{ $slot }}
                </div>
                <div class="col-12">{{ $title }}</h6>
                </div>
                <div class="col-12">
                    <a href="" class="card-link text-dark">Ver <i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>