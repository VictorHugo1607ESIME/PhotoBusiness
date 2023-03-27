@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-12 my-4 text-end">
            <a href="{{ URL('/admin/albums/add') }}" class="btn btn-primary">Agregar</a>
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
                        <th></th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


