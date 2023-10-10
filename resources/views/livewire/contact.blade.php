<div class="grid grid-cols-4 gap-4">
    <div class="col-span-4">
        <div class="mb-2">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre</label>
            <input type="text" id="name" wire:model.lazy='name'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required>
        </div>
    </div>
    <div class="col-span-2">
        <div class="mb-2">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Teléfono</label>
            <input type="phone" id="phone" wire:model.lazy='phone'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required>
        </div>
    </div>
    <div class="col-span-2">
        <div class="mb-2">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
            <input type="email" id="email" wire:model.lazy='email'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required>
        </div>
    </div>
    <div class="col-span-4">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 ">Mensaje</label>
        <textarea id="message" rows="5" wire:model.lazy='message'
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
            placeholder="Tu mensaje ..." required></textarea>
    </div>
    <div class="col-span-4 my-4">
        <div class="grid grid-cols-1">
            <button type="button" wire:click='save'
                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 font-bold {{ $btn }}">Envíar</button>
        </div>
    </div>


    <div class="grid grid-cols-1">
        <div class="text-center my-2">
            <i class="fa-solid fa-location-dot fa-5x" style="color:#DC2626"></i>
        </div>
        <div class="text-center">
            <label for="" class="col-12 mb-3">Horticultura 271 Colonia 20 de Noviembre C.P. 15300 Delegación
                Venustiano Carranza</label>
        </div>
    </div>
    <div class="grid grid-cols-1">
        <div class="text-center my-2">
            <i class="fa-solid fa-phone fa-5x" style="color:#DC2626"></i>
        </div>
        <div class="text-center">
            <label for="" class="col-12 mb-3">(52-55) 55-59-20-17</label>

        </div>
    </div>
    <div class="grid grid-cols-1">
        <div class="text-center my-2">
            <i class="fa-solid fa-envelope fa-5x" style="color:#DC2626"></i>
        </div>
        <div class="text-center">
            <label for="" class="col-12 mb-3"> Correo</label>
        </div>
    </div>
    <div class="grid grid-cols-1">
        <div class="text-center my-2">
            <i class="fa-brands fa-whatsapp fa-5x" style="color:#DC2626"></i>
        </div>
        <div class="text-center">
            <label for="" class="col-12 mb-3">WhatsApp</label>
        </div>
    </div>
</div>
