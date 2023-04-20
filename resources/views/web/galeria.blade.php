<div class="child-page-listing">
    <div class="col-12 mt-4 mb-4">
        <label class="titleSection col-12">{{ $result['description'] }}</label>
        @if(!$result['isCoverPhoto'])
            <label class="dataSsection col-12" for="">{{ $result['dataAlbum']->date }}  ({{ count($result['photos']) }} imágenes)</label>
        @endif
    </div>
    <div class="row d-flex">

        @foreach ($result['photos'] as $image)
        <a
        @if($result['generalData']['pageComprar'])
            onclick="selectImage({{json_encode($image)}})"
        @else
            @if($result['isCoverPhoto']) href="/album/{{ $image->id_album }}/{{ $image->album_name }}"
            @else href="/comprar/{{ $image->id_album }}/{{ $image->id }}" target="_blank"
            @endif
        @endif
        class="contentImgGeneral @if($image->image_with >= $image->image_height) contentImgWibe @else contentImgLong @endif ">

            <img class="imgAlbum" src="{{ $image->image_path }}" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> {{ $image->number_photos }} imágenes</label>
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
