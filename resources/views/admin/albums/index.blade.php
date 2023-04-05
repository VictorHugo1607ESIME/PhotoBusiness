@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-12 my-4 text-end">
            <x-btn-add url="{{ URL('/admin/albums/add') }}" />
        </div>
        <div class="col-12 col-sm-12 col-md-12">
            <div class="table-respose">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Empresa</th>
                        <th>Titulo</th>
                        <th>Estatus</th>
                        <th>Fecha</th>
                        <th># imagenes</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @if (!empty($result['albums']))
                            @foreach ($result['albums'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ $item->album_name }}</td>
                                    <td>{{ $item->album_status }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->images_count }}</td>
                                    <td>
                                        <x-btn-edit url="{{ URL('/admin/albums/edit', base64_encode($item->id)) }}">Editar
                                        </x-btn-edit>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
