@extends('layout.app')
@section('content')
<div class="">
    <h3 class="titleSection mt-3 mb-3">Cambiar nombre y contraseña</h3>
    <form class="col-5">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nuevo Nombre</label>
          <input type="email" class="form-control" id="newName" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="EMail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Campo obligatorio</div>
          </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="oldPass">
          <div id="emailHelp" class="form-text">Campo obligatorio</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nuevo Password</label>
            <input type="password" class="form-control" id="newPass">
            <div id="emailHelp" class="form-text">Campo obligatorio</div>
          </div>
        <button type="submit" class="btn btn-danger">Actualizar</button>
      </form>
</div>
<hr class="mt-5 mb-5">
<div>
    @include('web/galeria')
</div>
@endsection
