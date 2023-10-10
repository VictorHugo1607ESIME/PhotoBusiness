<div class="child-page-listing">
    <div class="grid grid-cols-1 gap-4 mb-4">
        <label class="titleSection col-12">{{ $result['description'] }}</label>
        @if (!$result['isCoverPhoto'])
            <p class="dataSection col-12" for="">{{ $result['dataAlbum']->date }} ({{ count($result['photos']) }}
                imágenes)</p>
        @endif
    </div>
    <div class="grid grid-cols-6 gap-1">
        @if (isset($result['photos']))
            @foreach ($result['photos'] as $image)
                <div class="cursor-pointer">
                    <a @if (!$result['isCoverPhoto'] && $result['generalData']['namePage'] == 'album') onclick="comprar({{ $image->id_album }}, {{ $image->id }})" @endif
                        @if ($result['generalData']['pageComprar']) onclick="selectImage({{ json_encode($image) }})"
            @else
                @if ($result['isCoverPhoto']) href="/album/{{ $image->id_album }}/{{ $image->album_name }}" @endif
                        @endif
                        class="contentImgGeneral @if ($image->image_with >= $image->image_height) contentImgWibe @else contentImgLong @endif ">

                        <img class="imgAlbum cursor-pointer"
                            src="{{ file_exists(public_path($image->optimice_path)) && $image->optimice_path != null ? asset($image->optimice_path) : asset($image->image_path) }}"
                            alt="" oncontextmenu="return false;" loading="lazy"
                            style="width: 360px; height: 240px;object-fit: scale-down;">
                        @if ($result['isCoverPhoto'])
                            <div class="contentNumberImage row">
                                <label class="numberImage" for=""><img class="iconNumberPhotos"
                                        src="{{ asset('icons/imageIcon.png') }}" alt="">
                                    {{ $image->number_photos }} imágenes</label>
                            </div>
                        @endif
                        @if ($result['isCoverPhoto'])
                            <div class="contentInfoAlbum column">
                                <label class="titleAlbum col-sm-12" for="">{{ $image->date }}</label>
                                <label class="titleAlbum col-sm-12" for="">{{ $image->album_name }}</label>
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach
        @else
            <div class="grid grid-cols-1 gap-4">
                <h3 class="col-12 text-center">Sin fotos</h3>
            </div>

        @endif

    </div>
</div>

<script>
    function comprar(idAlbum, idImage) {
        // Abrir una nueva ventana
        var url = "/comprar/" + idAlbum + "/" + idImage
        console.log(url)

        window.open(url, "_blank", "width=1300,height=1300")

        // Personalizar opciones de la nueva ventana
        //var ventanaNueva = window.open("https://www.example.com", "_blank", opciones);

    }
</script>
