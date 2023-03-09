<style>
.imgAlbumCarrito{
    object-fit: contain;
}

.optionsButtons{
    width: 100px;
}

.optionsText{
 font-size: 25px;
}
</style>
@extends('layout.app')
@section('content')
    <h3 class="titleSection mt-4 mb-4 col-12">Carrito de compra</h3>
    <div class="row d-flex justify-content-between">
        <div class="col-md-7 d-flex justify-content-center align-items-start bg-light">
            <img class="imgAlbumCarrito @if($result['isWideImage']) col-12 @else col-7 @endif" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM76967870_-960x1440.jpg" alt="">
            <!--https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM76877861_-960x640.jpg-->
        </div>
        <div class="col-md-4 column">
            <h5 class="col-12">Tamaño de la imágen</h5>
            <div class="form-check mt-2 d-flex align-items-center">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label optionsText" for="flexRadioDefault1">&nbsp;&nbsp;Pequeña</label>
            </div>
            <div class="form-check mt-2 d-flex align-items-center">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                <label class="form-check-label optionsText" for="flexRadioDefault2">&nbsp;&nbsp;Mediana</label>
            </div>
            <div class="form-check mt-2 mb-3 d-flex align-items-center">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" checked>
                <label class="form-check-label optionsText" for="flexRadioDefault3">&nbsp;&nbsp;Grande</label>
            </div>
            <button class="btn btn-danger mb-3">Añadir al carrito</button>
            <h2 class="">Encabezado</h2>
            <h2 class="text-muted">ID: 123456</h2>
            <h4 class="text-muted">Fecha: 12/03/2022</h4>
            <p class="text-muted mt-5 mb-5">Descripción: Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut .Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
        </div>
    </div>
@endsection
