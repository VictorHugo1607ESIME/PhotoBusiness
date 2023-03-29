@extends('admin.layout.layout')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-12 col-sm-12 col-md-6">
            <h2 class="text-center">Editar de album {{ $result['album']->album_name }}</h2>
            <form action="{{ URL('/admin/albums/insert') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $result['album']->album_name }}">
                <div class="mb-3">
                    <label for="album_name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="album_name" name="name"
                        value="{{ $result['album']->album_name }}">
                </div>
                <div class="mb-3">
                    <label for="album_date" class="form-label">Fecha de publicacion</label>
                    <input type="date" class="form-control" id="date" name="date"
                        value="{{ $result['album']->date }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Estatus</label>
                    <select name="status" id="status" class="form-control">
                        <option value="A" {{ $result['album']->album_status == 'A' ? 'selected' : '' }}>Activar
                        </option>
                        <option value="I" {{ $result['album']->album_status == 'I' ? 'selected' : '' }}>Deshabilitar
                        </option>
                    </select>
                </div>
               
                <div class="mb-3 text-center">
                   
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="mb-3">
            <form action="{{ url('/admin/images/upImage') }}" class="dropzone" id="my-awesome-dropzone">
                <input type="hidden" name="id" value="{{ $result['album']->album_name }}">
                @csrf
            </form>
        </div>
        <div class="">
            <div class="card">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let myDropzone = new Dropzone("div#my-awesome-dropzone");;
        });
        // Dropzone has been added as a global variable.
    </script>
@endsection
