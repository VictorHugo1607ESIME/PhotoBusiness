@extends('layout.app')
@section('content')
    {{-- @include('web/galeria') --}}
    @if ($result['photos'] && $search != null)
        <div class="container mx-auto my-4">
            <h3 class="text-xl font-semibold">Imagenes encontradas</h3>
        </div>
        <div class="container mx-auto">
            @livewire('images-search', ['search' => $search])
        </div>
        <div class="container mx-auto my-4">
            <h3 class="text-xl font-semibold">Albums encontradoss</h3>
        </div>
    @endif
    <div class="container mx-auto">
        @livewire('collections', ['search' => $search])
    </div>
@endsection
@section('js')
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
