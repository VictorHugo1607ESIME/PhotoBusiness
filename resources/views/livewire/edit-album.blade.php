<div>
    <div class="grid grid-cols-4 gap-4 ">

        <div class="col-span-4 text-center">
            <h2>{{ $name }}</h2>
        </div>
        <div class="col-span-2 col-start-2">
            <form wire:submit.prevent="updateData">
                <div class="mb-6">
                    <label for="albums_top" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album
                        en página princial</label>
                    <select id="albums_top" wire:model.lazy="albums_top"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option></option>
                        <option value="1">Primero</option>
                        <option value="2">Segundo</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="number_photos"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de fotos</label>
                    <input type="text" id="number_photos"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                         w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                         dark:focus:border-blue-500"
                        value="{{ $number_photos }}" readonly>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de
                        album</label>
                    <input type="text" id="name" wire:model.lazy='name'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                        publicación</label>
                    <input type="date" id="date" wire:model.lazy='date'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label for="album_keywords"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Palabras claves</label>
                    <input type="text" id="album_keywords" wire:model.lazy='album_keywords'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label for="exclusive" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album
                        exclusivo</label>
                    <select id="exclusive" wire:model.lazy='exclusive'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>y</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="status"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estatus</label>
                    <select id="status" wire:model.lazy="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="A">Activo</option>
                        <option value="E">Eliminar</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
                         font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>

                    </div>
                    <div class="text-end">
                        <a href="{{ URL('/admin/albums/add/images', $idAlbum) }}"
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none
                        focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700
                        dark:focus:ring-gray-700 dark:border-gray-700">
                            Imagenes
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>
