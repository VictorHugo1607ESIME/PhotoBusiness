<form action="{{ URL('/admin/users/update/pass') }}" method="POST">
    <input type="hidden" name="id" value="{{ $result['data']->id }}">
    @csrf
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control pass" id="password" name="password">
    </div>
    <div class="mb-3">
        <label for="password_rep" class="form-label">Contraseña</label>
        <input type="password" class="form-control pass" id="password_rep" name="password_rep">
    </div>
    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ URL('/admin/users') }}" class="btn btn-secondary">Volver</a>
        <button type="button" class="btn btn-outline-dark viewPass"><i class="fa-regular fa-eye"></i></button>
    </div>
</form>
