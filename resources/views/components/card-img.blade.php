<div
    class="block max-w-sm p-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700
        dark:hover:bg-gray-700">
    <div class="grid grid-cols-1 gap-4">
        <div class="w-100 flex justify-center">
            <img src="{{ $url }}" class="card-img-top" alt="{{ $alt }}"
                style="max-height: 250px;width: auto; max-width: 100%" />
        </div>
        @if ($id > 0)
            <div class="grid grid-cols-2 gap-2">
                <div class="grid grid-cols-3 gap-2">
                    <div class="text-center">
                        <input
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded
                        focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2
                        dark:bg-gray-700 dark:border-gray-600 select check{{$key}}" data-key="{{$key}}"
                            type="checkbox" value="{{ $id }}" wire:model="imagesCheck"
                            id="flexCheckDefault-{{ $id }}" style="cursor: pointer">
                        <label class="form-check-label" for="flexCheckDefault-{{ $id }}">
                        </label>
                    </div>
                    @if (($btnPrincipal == 'true' || $btnPrincipal == true) && $idPrincipal != $id)
                        <div class="col-span-2">
                            <button type="button" wire:click='principal({{ $id }})'
                                data-tooltip-target="tooltip-dark"
                                class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4
                        focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600
                        dark:hover:bg-purple-700 dark:focus:ring-purple-900">Principal</button>
                            <div id="tooltip-dark" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg
                                shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Seleccionar como imagen principal
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    @endif
                    @if ($idPrincipal == $id)
                        <div class="col-span-2">
                            <button type="button"
                                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300
                                font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">Principal</button>
                        </div>
                    @endif

                </div>
                <div>
                    <button
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4
            focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600
            dark:hover:bg-red-700 dark:focus:ring-red-900 btn-delete-img"
                        data-id="{{ $id }}" type="button">Eliminar({{$key}})</button>
                </div>
            </div>
        @endif
    </div>
</div>
