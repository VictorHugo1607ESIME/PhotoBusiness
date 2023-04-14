<form action="{{ url('/admin/albums/top/edit') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $album->id }}">
    <div class="modal-body">
        <div class="row">
            <div class="col-12 text-center">
                Colocar en top album {{ $album->album_name }}
            </div>
            <div class="col-12 mt-4">
                <div class="mb-3">
                    <label for="number" class="form-label">Top Album</label>
                    <input type="number" min="0" max="2" class="form-control" id="number" autofocus
                        name="album_top" value="{{ $album->albums_top != null ? $album->albums_top : 0 }}">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guarda</button>
    </div>
</form>
