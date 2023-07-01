<div>
    <div class="row mb-4  justify-content-between">
        <div class="col-3">
            <label for="album_id">Album</label>
            <select class="form-select" id="album_id" name="album_id" wire:model="album_id">
                <option value="">Todos</option>
                @foreach ($albums as $item)
                    <option value="{{ $item->id }}">{{ $item->album_name }}</option>
                @endforeach
            </select>
        </div>
        @if ($btndelete == true)
            <div class="col-2 text-right">
                <button type="button" wire:click="deleteImages" class="btn btn-outline-danger">Eliminar Imagenes</button>
            </div>
        @endif
    </div>

    <div class="row my-2">
        {{ $images->links() }}
    </div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="row">
        @foreach ($images as $item)
            <div class="col p-2 text-center">
                <x-card-img url="{{ asset($item->optimice_path) }}" alt="{{ $item->image_name }}"
                    id="{{ $item->id }}" />
            </div>
        @endforeach

    </div>
    <div class="row my-2">
        {{ $images->links() }}
    </div>


</div>
