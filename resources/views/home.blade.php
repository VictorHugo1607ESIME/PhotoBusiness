<style>
    .contentMainsPhotosHeigth{
        height: 65%;
        overflow: hidden;
    }

    .contentPhotos{
        height: 100%;
        overflow: hidden;
    }

    .mainContentPhoto{
        position: relative;
        display: inline-block;
    }

    .stylePhotos{
        object-fit: cover;
    }

    .stylePhotos:hover{
        filter: brightness(40%);
        transition: 300ms;
        transform:scale(1.25)
    }

    .stylePhotos:not(:hover){
        transition: 300ms;
    }

    .stylePhotos:{
        transition: 300ms;
    }

    .titleAlbum{
        position: absolute;
        bottom: 0%;
        left: 20px;
        font-size: 30px;
        color: white;
    }
</style>

@extends('layout.app')
@section('content')

    <div class="contentMainsPhotosHeigth col-12 d-flex justify-content-AROUND row">
        <div class="contentPhotos mainContentPhoto col-8">
            <img class="contentPhotos stylePhotos" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM59036077_-960x640.jpg" >
            <h5 class="titleAlbum">Diego Boneta Lanza su Marca de Tequila “Defrente”</h5>
        </div>
        <div class="contentPhotos mainContentPhoto col-md-3">
            <img class="contentPhotos stylePhotos" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM58376011_-960x1440.jpg" >
            <h5 class="titleAlbum col-sm-12">Conferencia de Prensa del Programa “La Corneta”</h5>
        </div>
    </div>

@include('galeria')
@endsection
