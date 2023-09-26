@extends('layout.app')
@section('content')
    {{-- @include('web/galeria') --}}
    <div class="container mx-auto">
        @livewire('images-album', ['idAlbum' => $idAlbum])
    </div>

    <script>
        function comprar(idAlbum, idImage) {
            // Abrir una nueva ventana
            var url = "/comprar/" + idAlbum + "/" + idImage
            console.log(url)

            window.open(url, "_blank", "width=1300,height=1300")

            // Personalizar opciones de la nueva ventana
            //var ventanaNueva = window.open("https://www.example.com", "_blank", opciones);

        }
    </script>
@endsection
