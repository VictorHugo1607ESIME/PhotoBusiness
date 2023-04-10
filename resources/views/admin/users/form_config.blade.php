<form action="{{ URL('/admin/users/update/config') }}" method="POST">
    <input type="hidden" name="id" value="{{ $result['data']->id }}">
    @csrf
    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ URL('/admin/users') }}" class="btn btn-secondary">Volver</a>
        <button type="button" class="btn btn-outline-dark viewPass"><i class="fa-regular fa-eye"></i></button>
    </div>
</form>
