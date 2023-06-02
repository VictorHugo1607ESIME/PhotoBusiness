@extends('admin.layout.layout')
@section('content')
    <div class="row">
        {{-- <div class="col-12 my-4 text-end">
            <x-btn-add url="{{ URL('/admin/albums/add') }}" />
        </div> --}}
        <div class="col-12 col-sm-12 col-md-12">
            <div class="table-respose">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Album</th>
                        <th>Fecha</th>
                        <th>Imagenes</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @if (!empty($result['albums']))
                            @foreach ($result['albums'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->album_name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->number_photos }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-3">
                                                <a href="{{ URL('/admin/albums/exclusives', $item->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-solid fa-share"></i>
                                                </a>
                                            </div>
                                            <div class="col-3">
                                                <x-btn-edit url="{{ URL('/admin/albums/edit', base64_encode($item->id)) }}">
                                                    <i class="fa-solid fa-pen"></i>
                                                </x-btn-edit>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->

@endsection
@section('js')
@endsection
