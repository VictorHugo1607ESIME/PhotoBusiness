@extends('layout.app')
@section('top')
    <div class="grid grid-cols-1">
        @livewire('home-top')
    </div>
@endsection
@section('content')
    {{-- <div class="contentMainsPhotosHeigth mb-2 mt-2 d-flex justify-content-between row">

        @foreach ($result['photosTop'] as $album)
            <a href="/album/{{ $album->id_album }}/{{ $album->album_name }}"
                class="mainContentPhoto col-sm-12 @if ($album->albums_top == 1) col-md-8 @else col-md-4 @endif">
                <img class="stylePhotos" src="{{ $album->image_path }}" oncontextmenu="return false">
                <div class="contentNumberImage row">
                    <label class="numberImage" for=""><img class="iconNumberPhotos"
                            src="{{ asset('icons/imageIcon.png') }}" alt=""> {{ $album->number_photos }}
                        imágenes</label>
                </div>
                <div class="contentInfoAlbum column">
                    <label class="titleAlbum col-sm-12">{{ $album->date }}</label>
                    <label class="titleAlbum col-sm-12">{{ $album->album_name }}</label>
                </div>
            </a>
        @endforeach


    </div> --}}


    <div class="grid grid-cols-1 text-center my-2 mx-0">
        <h1 class="text-3xl font-bold">Las mejores fotos de los espectáculos</h1>
    </div>
    <div class="grid grid-cols-1 m-0">
        @livewire('collections', ['search' => null])
    </div>
@endsection
