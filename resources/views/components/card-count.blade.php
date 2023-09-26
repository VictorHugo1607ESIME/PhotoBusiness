<div>
    <div class="block p-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
        style="background-color:{{ $color }}">
        <div class="grid grid-cols-1 gap-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    <h4 class="text-4xl text-white text-center font-bold mt-2">{{ $count }}</h4>
                </div>
                <div class=" text-right icono">
                    {{ $slot }}
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-3 font-bold"><h6>{{ $title }}</h6>
                </div>
                <div class="">
                    <a href="" class="card-link text-dark text-sm">Ver <i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
