<div class="container mx-auto">
    <div class="grid grid-cols-3 gap-10">
        @foreach ($images as $item)
            <div class="justify-center " onclick="comprar({{ $item->id_album }}, {{ $item->id }})"
                onclick="selectImage({{ json_encode($item) }})" style="width: 100%">
                <div class="flex justify-center contenedor_img mb-4 imageCollection" style="height: 300px;">
                    {{-- <div class="texto-encima"> <span><i class="fa-regular fa-images"></i>
                            {{ $item->number_photos }}</span></div> --}}
                    <button type="button" style="height: 300px" class="justify-center text-center">
                        <img src="{{ file_exists(public_path($item->optimice_path)) && $item->optimice_path != null ? asset($item->optimice_path) : asset($item->image_path) }}"
                            alt="" loading="lazy" style="height: 100%;object-fit: scale-down;" />
                    </button>
                </div>
                <div style="width: 100%" class="mt-2 mb-4">
                    <a href="{{ URL('album/' . $item->id_album . '/' . $item->album_name) }}" style="width: 100%">
                        <h2
                            class=" font-sans text-black text-center text-sm font-semibold subpixel-antialiased textCollection">
                            {{ $item->image_title }}</h2>
                        <p
                            class="font-sans text-black text-center text-sm font-semibold subpixel-antialiased textCollection">
                            <span class="font-bold">Album:</span> {{ $item->album_name }}
                        </p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
