<div>
    <div class="grid grid-cols-1 my-6">
        <div class="grid grid-cols-6 gap-2">
            <div class="col-span-1">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('/images/logo-entrefam.jpeg') }}" style="height: 50px" alt="Logo">
                </a>
            </div>
            <div class="col-span-4">
                <form method="GET" action="{{ URL('/collections') }}">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Buscador</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" name="search"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                            placeholder="buscar artista, evento ...">
                        <button type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-red-800 hover:bg-red-200 hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 "><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-span-1 text-center">
                <div class="grid grid-cols-1 gap-2 text-center">
                    <div class="text-end">
                        <button type="button"
                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300
                    font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Contacto</button>
                        @if (session('isLogin') == true)
                            <a href="{{ URL('/logout') }}"
                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300
            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 cursor-pointer"><i
                                    class="fa-solid fa-right-from-bracket"></i></a>
                        @else
                            <button type="button"
                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300
            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 openLogin cursor-pointer">Login</button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
