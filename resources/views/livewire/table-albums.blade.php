<div class="mt-4">
    <div class="grid grid-cols-1 gap-4">
        <table id="myTable" class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <th scope="col" class=" py-3">
                    ID
                </th>
                <th scope="col" class=" py-3" style="max-height: 300px">
                    Album
                </th>
                <th scope="col" class=" py-3">
                    Estatus
                </th>
                <th scope="col" class=" py-3">
                    Fecha
                </th>
                <th scope="col" class=" py-3">
                    Imagenes
                </th>
                <th scope="col" class=" py-3">
                    Top
                </th>
                <th scope="col" class=" py-3">

                </th>
            </thead>
            <tbody>
                @if (count($albums) > 0)
                    @foreach ($albums as $item)
                        <tr class="bg-white border-b">
                            <td class=" py-3">
                                {{ $item->id }}
                            </td>
                            <td class=" py-3" style="max-height: 300px">
                                {{ $item->album_name }}
                            </td>
                            <td class=" py-3">
                                <x-status value="{{ $item->album_status }}" />
                            </td>
                            <td class=" py-3">
                                {{ $item->date }}
                            </td>
                            <td class="py-3 text-center">
                                <p class="font-bold"> {{ $item->number_photos }}</p>
                            </td>
                            <td class=" py-3">
                                @if ($item->albums_top == 1)
                                    <button type="button"
                                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300
                                        font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Top
                                        1</button>
                                @endif
                                @if ($item->albums_top == 2)
                                    <button type="button"
                                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4
                                focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 ">Top
                                        2</button>
                                @endif

                            </td>
                            <td class=" py-3">
                                <div class="flex flex-row self-center">
                                    <div class="mt-1">
                                        <a href="{{ url('admin/albums/edit', base64_encode($item->id)) }}"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4
                                            focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                                class="fa-solid fa-pencil"></i></a>

                                    </div>
                                    <div class="mt-1">
                                        <a href="{{ URL('/admin/albums/add/images', $item->id) }}"
                                            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300
                                            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"><i
                                                class="fa-solid fa-images"></i></a>
                                    </div>
                                    <div class="m-0 p-0 flex self-start ">
                                        <button type="button" wire:click='deleteAlbum({{ $item->id }})'
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg
                                            text-sm px-5 py-2.5 mr-2 mb-2 "><i
                                                class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                @endif
            </tbody>
        </table>
    </div>
</div>
