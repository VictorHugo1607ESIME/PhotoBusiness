<div class="container mx-auto">
    <div class="grid grid-cols-3 gap-10">
        @foreach ($images as $item)
            <div>
                <div class="justify-center contenedor_img mb-4 imageCollection"
                    style="max-height: 300px;overflow: hidden">
                    <div class="texto-encima"> <span><i class="fa-regular fa-images"></i>
                            {{ $item->number_photos }}</span></div>
                    <a href="{{ URL('album/' . $item->album_id . '/' . $item->album_name) }}" style="max-height: 300px">
                        <img src="{{ asset($item->optimice_path) }}" alt="" loading="lazy"
                            style="height: auto;" />
                    </a>
                </div>
                <div style="width: 100%">
                    <a href="{{ URL('album/' . $item->album_id . '/' . $item->album_name) }}" style="width: 100%">
                        <h2
                            class="mt-2 mb-4 font-sans text-black text-center text-sm font-semibold subpixel-antialiased textCollection">
                            {{ $item->album_name }}</h2>
                    </a>
                </div>
            </div>
        @endforeach
    </div>


    {{-- <div class="" style="width: 100%">
        <div
            style="display: flex; width: 100%;flex-flow: row wrap;gap: 0.3rem; align-items: center;justify-content: start;">
            @foreach ($images as $item)
                @if ($item->image_with > $item->image_height)
                    <div style="width: 360px; height: 240px;" class="contenedor_img" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="{{ $item->album_name }}">
                        <div class="texto-encima"> <span><i class="fa-regular fa-images"></i>
                                {{ $item->number_photos }}</span></div>
                        <a href="{{ URL('album/' . $item->album_id . '/' . $item->album_name) }}">
                            <img src="{{ asset($item->optimice_path) }}" alt="" loading="lazy"
                                style="width: 360px; height: 240px;object-fit: scale-down;" />
                        </a>
                        <div class="texto-debajo">{{ $item->album_name }}</div>
                    </div>
                @else
                    <div style="width: 168px; height: 240px;" class="contenedor_img" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="{{ $item->album_name }}">
                        <div class="texto-encima"><i class="fa-regular fa-images"></i> {{ $item->number_photos }}</div>
                        <a href="{{ URL('album/' . $item->album_id . '/' . $item->album_name) }}">
                            <img src="{{ asset($item->optimice_path) }}" alt="" loading="lazy"
                                style="width: 168px; height: 240px;object-fit: scale-down;" />
                        </a>
                        <div class="texto-debajo">{{ $item->album_name }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div> --}}
    <div class="grid grid-cols-1 text-center mt-5">
        {{ $images->links() }}
    </div>

    {{-- <div class="content">
        <div class="gg-container">
            <div class="gg-box dark" id="horizontal">
                @foreach ($images as $item)
                    <div style="width: 100%; height: 100%;" class="contenedor_img bg-slate-700"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item->album_name }}">
                        <div class="texto-encima"><i class="fa-regular fa-images"></i> {{ $item->number_photos }}</div>
                        <a href="{{ URL('album/' . $item->album_id . '/' . $item->album_name) }}">
                            @if ($item->image_with > $item->image_height)
                                <img src="{{ asset($item->optimice_path) }}" alt="" loading="lazy"
                                    width="180" height="60" />
                            @else
                                <img src="{{ asset($item->optimice_path) }}" alt="" loading="lazy"
                                    width="60" height="90" style="object-fit:contain; " />
                            @endif
                        </a>
                        <div class="texto-debajo">{{ $item->album_name }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 text-center mt-5">
        {{ $images->links() }}
    </div> --}}
</div>
