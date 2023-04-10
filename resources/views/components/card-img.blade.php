<div>
    <div class="card" style="width: 18rem; height: 20rem">
        <div class="card-body">
            <div class="row ">
                <div class="col-12 text-center showImagen" data-id="{{ $id }}">
                    <div style="width: 100%;height: 100%;">
                        <img src="{{ $url }}" class="card-img-top" alt="{{ $alt }}" loading="lazy"
                            style="max-height: 250px;width: auto; max-width: 100%">
                    </div>
                </div>
                @if ($id > 0)
                    <div class="row">
                        <div class="col-10">
                            <div class="d-grid gap-1 mt-1">
                                <button class="btn  btn-outline-danger deletedImagen" data-id="{{ $id }}"
                                    type="button">Eliminar</button>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-grid gap-1 mt-1">
                                <a class="btn  btn-outline-primary" href="{{ url('/admin/images/edit', $id) }}">Info</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
