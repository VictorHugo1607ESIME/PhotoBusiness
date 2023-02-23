@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <form action="/file-upload" class="dropzone" id="my-awesome-dropzone"></form>

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
