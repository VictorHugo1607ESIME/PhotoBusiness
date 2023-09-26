<div>
    <form wire:submit.prevent="save">
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" wire:model.lazy='email'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
            dark:focus:border-blue-500"
                required autocomplete="off">
        </div>
        <div class="mb-6">
            <label for="user_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de
                usuario</label>
            <input type="text" id="user_name" wire:model.lazy='user_name'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
            block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required autocomplete="off">
        </div>
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre </label>
            <input type="text" id="name" wire:model.lazy='name'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
            block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required autocomplete="off">
        </div>
        <div class="mb-6">
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido
            </label>
            <input type="text" id="last_name" wire:model.lazy='last_name'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
            block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required autocomplete="off">
        </div>
        <div class="mb-6">
            <div class="grid grid-cols-10 mb-4 gap-4">
                <div class="col-span-9">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña
                    </label>
                    <input type="{{ $type }}" id="last_name" wire:model.lazy='password'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                    block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required autocomplete="off">
                </div>
                <div class="flex items-end">
                    @if ($type == 'password')
                        <button type="button" wire:click='typeChange'
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300
                font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"><i
                                class="fa-regular fa-eye"></i></button>
                    @else
                        <button type="button" wire:click='typeChange'
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300
        font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"><i
                                class="fa-solid fa-eye-slash"></i></button>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-3 text-center">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2
            dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>
            <a href="{{ URL('/admin/users') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4
            focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Volver</a>
        </div>
    </form>
</div>
