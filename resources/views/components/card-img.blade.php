<div>
    <div class="card" style="width: 18rem;">
        <div class="row">
            <div class="col-12">
                <img src="{{ $url }}" class="card-img-top" alt="{{ $alt }}">

            </div>
            @if ($id > 0)
                <div class="col-12">
                    <div class="d-grid gap-2">
                        <button class="btn  btn-outline-danger deletedImagen" data-id="{{ $id }}"
                            type="button">Eliminar</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
