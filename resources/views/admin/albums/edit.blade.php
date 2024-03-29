@extends('admin.layout.layout')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-12 col-sm-12 col-md-6">
            <h2 class="text-center">Editar de album {{ $result['album']->album_name }}</h2>
            <form action="{{ URL('/admin/albums/update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id_album" value="{{ $result['album']->id }}">
                <div class="mb-3">
                    <label for="album_name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="album_name" name="name"
                        value="{{ $result['album']->album_name }}">
                </div>
                <div class="mb-3">
                    <label for="album_date" class="form-label">Fecha de publicación</label>
                    <input type="date" class="form-control" id="date" name="date"
                        value="{{ $result['album']->date }}">
                </div>
                <div class="mb-3">
                    <label for="album_keywords" class="form-label">Palabras claves (ejemplo, ejemplo 1, ejemplo 2,
                        ......')</label>
                    <input type="keywords" class="form-control" id="album_keywords" name="album_keywords"
                        value="{{ $result['album']->album_keywords }}">
                </div>
                <div class="mb-3">
                    <label for="exclusive" class="form-label">Album exclusivo</label>
                    <select class="form-select" aria-label="" name="exclusive" id="exclusive">
                        <option value="0" {{ $result['album']->exclusive == '0' ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $result['album']->exclusive == '1' ? 'selected' : '' }}>Si</option>
                    </select>
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
                    <x-btn-form></x-btn-form>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="mb-3">
            <form action="{{ url('/admin/albums/upImage') }}" method="POST" enctype="multipart/form-data" class="dropzone"
                id="dropzone">
                <input type="hidden" name="slug" value="{{ $result['album']->album_slug }}">
                @csrf
            </form>
        </div>
        <div class="card ">
            <div class="card-body p-2" id="html_images">
                {!! $result['html_images'] !!}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let id = $('#id_album').val();


            setInterval(get_images(id), 1000);
            let myDropzone = Dropzone("#dropzone", {
                dictDefaultMessage: "Your default message Will work 100%",
                addedfile: file => {
                    // ONLY DO THIS IF YOU KNOW WHAT YOU'RE DOING!
                }
            }).then(() => {
                console.log('Termino');
            }).catch((error) => {
                console.error(error);
            });

        });

        // Dropzone has been added as a global variable.
    </script>
@endsection
