<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
    <div class="grid grid-cols-4 gap-4 text-center">
        <div class="col-span-4">
            <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Iniciar sesión</h1>
        </div>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-4">
            <form id="formLogin" method="POST" action="{{ route('login') }} ">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" id="email" wire:model.lazy="recipientEmail" name="recipientEmail"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 "
                        required>
                </div>
                <div class="mb-6">
                    <div class="grid grid-cols-6 gap-4 flex">
                        <div class="col-span-5">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Contraseña</label>
                            <input type="{{ $type }}" id="password" wire:model.lazy="recipientPass"
                                name="recipientPass"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                        </div>
                        <div class="mt-4 self-end m-0">
                            <button type="button" wire:click='changeType'
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5
                            mr-2">{!! $button !!}</button>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-2 text-end">
                        <button type="submit" onclick="clickLogIn()"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5
                        py-2.5 mr-2 mb-2 ">Acceder</button>
                    </div>
                    <div class="col-span-2">
                        <button type="button" data-izimodal-close=""
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Cerrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
