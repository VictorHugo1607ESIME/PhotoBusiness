<div>
    <div class="card" style="width: 18rem; height: 20rem">
        <div class="card-body">
            <div class="row ">
                <div class="col-12 text-center">
                    <div style="width: 100%;height: 100%;">
                        <img src="{{ $url }}" class="card-img-top" alt="{{ $alt }}" loading="lazy"
                            style="max-height: 250px;width: auto; max-width: 100%">
                    </div>
                </div>
                @if ($id > 0)
                    <div class="col-12">
                        <div class="d-grid gap-2 mt-1">
                            <button class="btn  btn-outline-danger deletedImagen" data-id="{{ $id }}"
                                type="button">Eliminar</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
