<div>
    @if ($update == true)
        <div class="grid grid-cols-3 gap-4 my-4">
            <div>
                <a href="{{ URL('/admin/albums') }}"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Albums
                </a>
            </div>
            <div class="text-center">
                <a href="{{ URL('/admin/albums/edit', base64_encode($album_id)) }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Editar album
                </a>
            </div>
            <div class="text-end">
                <button type="button" wire:click='actualizar' id="btn_actualizar"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5
                    py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 images_titule">Actualizar</button>
            </div>
        </div>
    @endif
    @if ($view_images == false)
        <div class="grid grid-cols-4 gap-4 my-4">
            <div class="col-span-2">
                <label for="album_id">Album</label>
                <select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block
            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
            dark:focus:border-blue-500"
                    id="album_id" name="album_id" wire:model.lazy="album_id">
                    <option value="">Todos</option>
                    @foreach ($albums as $item)
                        <option value="{{ $item->id }}">{{ $item->album_name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($btndelete == true)
                <div class="grid-span-2 text-right">
                    <button type="button" id="selectEliminar"
                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium
                rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2
                dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar
                        Imagenes seleccionadas</button>
                </div>
                <div class="hidden"> <button type="button" id="bntEliminar" wire:click="deleteImages">eliminar</button>
                </div>
            @endif
        </div>
    @else
        @if ($btndelete == true)
            <div class="grid grid-cols-1 gap-4 my-4">
                <div class="grid-span-2 text-right">
                    <button type="button" id="selectEliminar"
                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium
        rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2
        dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar
                        Imagenes seleccionadas</button>
                </div>
                <div class="hidden"> <button type="button" id="bntEliminar" wire:click="deleteImages">eliminar</button>
                </div>
            </div>
        @endif
    @endif
    <div class="grid grid-cols-1 gap-4 my-2 text-right">
        {{ $images->links() }}
    </div>
    <div class="grid grid-cols-3 gap-4 my-2">
        @foreach ($images as $key=> $item)
            <div class="grid-span-2">
                <x-card-img key="{{$key}}" url="{{ asset($item->optimice_path) }}" alt="{{ $item->image_name }}"
                    id="{{ $item->id }}" btnPrincipal="{{ ((int)$album_id) > 0 ? true : false }}"
                    idPrincipal="{{ $id_principal }}" />
            </div>
        @endforeach

    </div>
    <div class="grid grid-cols-1 gap-4 my-2 text-right">
        {{ $images->links() }}
    </div>

    {{-- <div class="hidden"> --}}
    <div class="hidden">
        <form wire:submit.prevent="deleteOnlyImg">
            <input type="text" id="delete_img" wire:model.debounce.3000msy='delete'>
            <button type="submit" id="submitDeleteImg">Eliminar</button>
        </form>
    </div>
</div>
