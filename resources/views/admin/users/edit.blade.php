@extends('admin.layout.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 text-center">
            <h2>Editar el usuario</h2>
        </div>
        <div class="col-12 col-sm-12 col-md-6">
            <form action="{{ URL('/admin/users/insert')}}" method="POST">
                <input type="hidden" name="id" value="{{ $result['data']->id }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $result['data']->email }}">
                </div>
                <div class="mb-3">
                    <label for="user_name" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $result['data']->user_name }}">
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"  value="{{ $result['data']->first_name }}">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $result['data']->last_name }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rol</label>
                    <select class="form-control" name="role" id="role">
                        <option value="2">Usuario</option>
                        <option value="1">Administrador</option>
                    </select>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ URL('/admin/users') }}" class="btn btn-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
