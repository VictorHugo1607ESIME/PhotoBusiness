<div class="child-page-listing">
    <div class="col-12 mt-4 mb-4">
        <label class="titleSection col-12">{{ $result['description'] }}</label>
        @if(!$result['isCoverPhoto'])
            <p class="dataSection col-12" for="">{{ $result['dataAlbum']->date }}  ({{ count($result['photos']) }} imágenes)</p>
        @endif
    </div>
    <div class="row d-flex">

        @foreach ($result['photos'] as $image)
        <a @if(!$result['isCoverPhoto'] && $result['generalData']['namePage'] == 'album') onclick="comprar({{$image->id_album}}, {{$image->id}})" @endif
        @if($result['generalData']['pageComprar'])
            onclick="selectImage({{json_encode($image)}})"
        @else
            @if($result['isCoverPhoto']) href="/album/{{ $image->id_album }}/{{ $image->album_name }}"
            @endif
        @endif
        class="contentImgGeneral @if($image->image_with >= $image->image_height) contentImgWibe @else contentImgLong @endif ">

            <img class="imgAlbum" src="@if($image->optimice_path != null) {{$image->optimice_path}} @else {{$image->image_path}} @endif" alt="" oncontextmenu="return false;">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage row">
                    <label class="numberImage" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> {{ $image->number_photos }} imágenes</label>
                </div>
            @endif
            @if($result['isCoverPhoto'])
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">{{ $image->date }}</label>
                <label class="titleAlbum col-sm-12" for="">{{ $image->album_name }}</label>
            </div>
            @endif
        </a>
        @endforeach


    </div>
  </div>

  <script>
    function comprar(idAlbum, idImage){
        // Abrir una nueva ventana
        var url = "/comprar/"+idAlbum+"/"+idImage
        console.log(url)

        window.open(url, "_blank", "width=1300,height=1300")

        // Personalizar opciones de la nueva ventana
        //var ventanaNueva = window.open("https://www.example.com", "_blank", opciones);

    }
  </script>
