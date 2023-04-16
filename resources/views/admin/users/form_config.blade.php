<form action="{{ URL('/admin/users/update/config') }}" method="POST">
    <input type="hidden" name="id" value="{{ $result['data']->id }}">
    @csrf
    <div class="mb-3">
        <label for="users_max_onlien" class="form-label">Máximo de usuarios conectados</label>
        <input type="number" class="form-control pass" id="users_max_onlien" name="users_max_onlien" min="0"
            max="99" aria-describedby="users_max_onlienHelp"
            value="{{ $result['data']->users_max_onlien > 0 ? $result['data']->users_max_onlien : 0 }}">
        <div id="users_max_onlienHelp" class="form-text">Número máximo de conecciones simultaneas. 0 (cero) ilimitadas.
        </div>
    </div>
    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ URL('/admin/users') }}" class="btn btn-secondary">Volver</a>
    </div>
</form>
