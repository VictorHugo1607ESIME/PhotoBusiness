@extends('admin.layout.app2')
@section('content')
    <div class="grid grid-cols-1 gap-4">
        @livewire('edit-album', ['idAlbum' => $result['id']])
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
