<form action="{{ URL('/admin/users/insert') }}" method="POST">
    <input type="hidden" name="id" value="{{ $result['data']->id }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $result['data']->email }}">
    </div>
    <div class="mb-3">
        <label for="user_name" class="form-label">Nombre de usuario</label>
        <input type="text" class="form-control" id="user_name" name="user_name"
            value="{{ $result['data']->user_name }}">
    </div>
    <div class="mb-3">
        <label for="first_name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="first_name" name="first_name"
            value="{{ $result['data']->first_name }}">
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="last_name" name="last_name"
            value="{{ $result['data']->last_name }}">
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Rol</label>
        <select class="form-control" name="role_id" id="role_id">
            <option value="2"  {{ $result['data']->id_role=='2' ? 'selected':'' }}>Usuario</option>
            <option value="1"  {{ $result['data']->id_role=='1' ? 'selected':'' }}>Administrador</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Estatus</label>
        <select class="form-control" name="status" id="status">
            <option value="A" {{ $result['data']->status == 'A' ? 'selected' : '' }}>Activo</option>
            <option value="I" {{ $result['data']->status == 'I' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>
    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ URL('/admin/users') }}" class="btn btn-secondary">Volver</a>
    </div>
</form>
