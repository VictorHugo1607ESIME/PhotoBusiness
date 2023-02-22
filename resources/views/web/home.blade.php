<style>
    .contentMainsPhotosHeigth{
        height: 75%;
        overflow: hidden;
    }

    .mainContentPhoto{
        height: 100%;
        position: relative;
        display: inline-block;
        overflow: hidden;
        cursor: pointer;
    }
</style>

@extends('layout.app')
@section('content')

    <div class="contentMainsPhotosHeigth mb-2 mt-2 d-flex justify-content-between row">

        <a href="" class="mainContentPhoto col-sm-12 col-md-9">
            <img class="stylePhotos" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM59036077_-960x640.jpg" >
            <div class="contentNumberImage col-12 row">
                <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
            </div>
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12">Fecha: 12 - 08 - 2023</label>
                <label class="titleAlbum col-sm-12">Diego Boneta Lanza su Marca de Tequila “Defrente”</label>
            </div>
        </a>

        <a href="" class="mainContentPhoto col-sm-12 col-md-3">
            <img class="stylePhotos col-md-12" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM58376011_-960x1440.jpg" >
            <div class="contentNumberImage col-12 row">
                <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
            </div>
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12">Fecha: 12 - 08 - 2023</label>
                <label class="titleAlbum col-sm-12">Conferencia de Prensa del Programa “La Corneta”</label>
            </div>
        </a>

    </div>

@include('web/galeria')
@endsection
