<style>
    .imageShopping{
        width: auto;
        height: 120px;
    }
</style>
@extends('layout.app')
@section('content')
<div class="col-12 d-flex justify-content-between mt-4">
   <h3 class="titleSection col-5">Carrito de compra</h3>
   <button type="button" class="col-1 btn btn-danger">Descargar</button>
</div>
<div class="col-2 mt-3 mb-3">
    <select class="form-select" aria-label="Default select example">
        <option selected>Selecciona un tamaño</option>
        <option value="1">Pequeña</option>
        <option value="2">Mediana</option>
        <option value="3">Grande</option>
      </select>
</div>
<div class="col-12 mt-4">
    <div class="col-12 row rounded-4 border border-2 mb-2 p-2">
        <div style="width:40px" class="d-flex justify-content-center align-items-center"><input class="form-check-input mt-0" type="checkbox" value=""></div>
        <div class="col col-2 d-flex justify-content-center align-items-center"><img class="imageShopping" src="https://entrefam.com/wp-content/uploads/2023/03/ENTREFAM16861860_-960x640.jpg" alt=""></div>
        <div class="col">
            <h4>The Black Crowes</h4>
            <p>23-08-2022</p>
        </div>
    </div>

    <div class="col-12 row rounded-4 border border-2 mb-2 p-2">
        <div style="width:40px" class="d-flex justify-content-center align-items-center"><input class="form-check-input mt-0" type="checkbox" value=""></div>
        <div class="col col-2 d-flex justify-content-center align-items-center"><img class="imageShopping" src="https://entrefam.com/wp-content/uploads/2023/03/ENTREFAM16951869_-960x1440.jpg" alt=""></div>
        <div class="col">
            <h4>The Black Crowes</h4>
            <p>23-08-2022</p>
        </div>
    </div>
</div>

@endsection
