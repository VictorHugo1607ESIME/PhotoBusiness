<div>
    <div class="relative overflow-x-auto">
        <table id="myTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estatus
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modificación
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($data != null)
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4">
                                {{ $item->id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->first_name }} {{ $item->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4">
                                <x-status value="{{ $item->status }}" />
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->updated_at }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ url('admin/users/edit', $item->id) }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4
                                    focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700
                                    dark:focus:ring-blue-800"><i
                                        class="fa-solid fa-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- <div class="table-respose">
        <table id="myTable" class="table table-striped">
            <thead>
                <th>Id</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estatus</th>
                <th>Modificación</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user_name }}</td>
                        <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <x-status value="{{ $item->status }}" />
                        </td>
                        <td>{{ $item->updated_at }}</td>
                        <td class="text-end">
                            <a href="{{ url('admin/users/edit', $item->id) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-pencil"></i></a>
                            <button class="btn btn-danger deletedUser" data-id="{{ $item->id }}"><i
                                    class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div> --}}
</div>
