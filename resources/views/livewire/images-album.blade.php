<div>
    <div class="grid grid-cols-1 gap-4 mt-2">
        <h2 class="font-bold text-lg">{{ $album->album_name }}</h2>
        <p class="">{{ $album->date }} <span>Imagenes: {{ $album->number_photos }}</span></p>
    </div>
    <div class="grid grid-cols-1 mt-2">
        <div class="font-sans" {{-- align-items: center;justify-content: center; --}}
            style="display: flex; width: 100%;flex-wrap: wrap;gap: 4px">
            @foreach ($images as $item)
                @if ($item->image_with > $item->image_height)
                    <div class="mb-4 justify-center" style="width: 360px;">
                        <div style="width: 360px; height: 240px;"class="contenedor_img" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="{{ $item->image_title }}"
                            onclick="comprar({{ $item->id_album }}, {{ $item->id }})"
                            onclick="selectImage({{ json_encode($item) }})">
                            <a href="{{ URL('album/' . $item->id_album . '/' . $item->album_name) }}">
                                <img src="{{ asset($item->optimice_path) }}" alt="" loading="lazy"
                                    style="width: 360px; height: 240px;object-fit: scale-down;" />
                            </a>

                        </div>
                        <div class="my-1 text-center">
                            <p class="text-sm font-semibold">{{ $item->image_title }}</p>
                            {{-- <p> {{ $item->id }}</p>
                            <p>{{ 'W' . $item->image_with . '- H' . $item->image_height }}</p> --}}
                        </div>
                    </div>
                @else
                    <div style="width: 180px;" class="mb-4 ">
                        <div style="width: 180px; height: 240px;" class="contenedor_img" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="{{ $item->image_title }}"
                            onclick="comprar({{ $item->id_album }}, {{ $item->id }})"
                            onclick="selectImage({{ json_encode($item) }})">
                            <a href="{{ URL('album/' . $item->id_album . '/' . $item->album_name) }}">
                                <img src="{{ asset($item->optimice_path) }}" alt="" loading="lazy"
                                    style="width: 180px; height: 240px;object-fit: scale-down;" />
                            </a>
                        </div>
                        <div class="my-1 text-center">
                            <p class="text-sm font-semibold">{{ $item->image_title }}</p>
                            {{-- <p> {{ $item->id }}</p>
                            <p>{{ 'W ' . $item->image_with . '- H ' . $item->image_height }}</p> --}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-12 my-5">
        {{ $images->links() }}
    </div>
</div>
