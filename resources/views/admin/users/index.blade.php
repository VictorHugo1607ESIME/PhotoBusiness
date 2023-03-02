@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-12 my-4 text-end">
            <a href="{{ URL('/admin/users/add') }}" class="btn btn-primary">Agregar</a>
        </div>
        <div class="col-12 col-sm-12 col-md-12">
            <div class="table-respose">
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
                        @foreach ($result['users'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td></td>
                                <td>{{ $item->updated_at }}</td>
                                <td class="text-end">
                                    <a href="{{ url('admin/users/edit',$item->id)}}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>


        </div>

    </div>
@endsection
@section('js')
@endsection
