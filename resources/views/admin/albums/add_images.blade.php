@extends('admin.layout.app2')
@section('css')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-4 mb-4 text-center">
        <h1>{{ $result['album']->album_name }}</h1>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-4">
            <form action="{{ url('/admin/albums/upImage') }}" method="POST" enctype="multipart/form-data" class="dropzone"
                id="my-dropzone">
                <input type="text" name="album_id" value="{{ $id }}" style="display: none">
                <input type="hidden" name="slug" value="{{ $result['album']->album_slug }}">
                @csrf
            </form>
        </div>
    </div>
    <div>
        @livewire('album-add-images', ['album_id' => $id])
    </div>
@endsection
@section('js')
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

    {{-- <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            Dropzone.options.myGreatDropzone = { // camelized version of the `id`
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 4, // MB
                maxFiles: 100,
                acceptedFiles: 'image/*',
                parallelUploads: 20,
                dictDefaultMessage: "Coloca la imagen",
                accept: function(file, done) {
                    $('#btn_actualizar').trigger('click');
                    console.log(done);
                },
                init: function() {
                    this.on("addedfile", file => {
                        console.log("A file has been added");
                    });
                }
            };
        });
    </script> --}}
    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            Dropzone.options.myDropzone = {
                paramName: "file",
                maxFilesize: 4, // MB
                maxFiles: 100,
                acceptedFiles: ".jpg, .jpeg, .png, .gif",
                init: function() {
                    this.on("uploadprogress", function(file, progress, bytesSent) {
                        console.log(progress);
                    });
                }
            };
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#sync_ftp', function() {
                sync();
            });

            function sync() {
                cargando();
                $.ajax({
                    type: "get",
                    url: "<?= URL('/sync_manual') ?>",
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.code == 200) {
                            loop();
                        } else {
                            Swal.fire(
                                'Termino',
                                'Proceso terminado',
                                'info'
                            )
                        }
                    }
                });
            }

            function loop() {
                let timerInterval
                Swal.fire({
                    title: 'Continuamos',
                    html: 'Continuamos procesando espera <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        sync();
                    }
                })
            }
            $('#modal').iziModal('open');

            $(document).on('click', '.btn-delete-img', function(event) {
                event.preventDefault();
                let id_img = $(this).data('id');
                console.log('click ', +id_img);
                $('#delete_img').val(id_img);
                Swal.fire({
                    title: 'Eliminar Imagen',
                    text: "¿Estas seguro de eliminar la imagen?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#C0392B',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Si, borrar imagen'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete_img').val(id_img);
                        let element = document.getElementById('delete_img');
                        element.dispatchEvent(new Event('input'));
                        $('#submitDeleteImg').trigger('click');
                    }
                })
            });
            $(document).on('click', '#selectEliminar', function() {
                Swal.fire({
                    title: 'Eliminar Imagenes',
                    text: "¿Estas seguro de eliminar las imagenes?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#C0392B',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Si, borrar toda las seleccionadas'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bntEliminar').trigger('click');
                    }
                })
            });
        });
    </script>
    <script>
        var imagen = "";
        var id = "";
        (function(window, document) {
            'use strict';
            $(document).on('click', '.images_titule', function() {
                datos();
            });
            if (!supportsFileReader()) {
                alert('Sorry, your web browser does not support the FileReader API.');
                return;
            }
            // window.addEventListener('load', function() {
            //     document.querySelector('form').addEventListener('submit', handleSubmit, false);
            // }, false);
            console.log('inicio');

            function supportsFileReader() {
                return window.FileReader !== undefined;
            }

            function datos() {
                console.log('datos');
                cargando();
                $.ajax({
                    type: "get",
                    url: "<?= URL('/getimageInfo') ?>",
                    dataType: "JSON",
                    success: function(res) {
                        if (res.image != '') {
                            imagen = res.image;
                            id = res.id;
                            handleSubmit(imagen, id);
                            supportsFileReader();
                        } else {

                            console.log(res.image);
                            console.log('sin datos');
                            location.reload();
                        }
                    }
                });
            }

            function handleSubmit(imagen, id) {
                console.log('procesaendo imagen');
                console.log(imagen);
                // event.preventDefault();

                // const file = event.target.elements.file.files[0];
                const url = imagen;
                // http://127.0.0.1:8000/img/alfombra_de_fashion_lounge_de_bcbgmaxazria/ENTREFAM52085382_.jpg
                // public\img\Alfombra de Fashion Lounge de BCBGMAXAZRIA\ENTREFAM52115385_.jpg
                ExifReader.load(url).then(function(tags) {
                    console.log('enviando info');
                    $.ajax({
                        type: "post",
                        url: "<?= URL('/setInfoImages') ?>",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "data": tags
                        },
                        dataType: "JSON",
                        success: function(res) {
                            console.log('proceso realizado');
                            datos();
                        }
                    });
                    // console.log(tags);
                    // The MakerNote tag can be really large. Remove it to lower
                    // memory usage if you're parsing a lot of files and saving the
                    // tags.
                    // delete tags['MakerNote'];
                    // // If you want to extract the thumbnail you can use it like
                    // // this:
                    // if (tags['Thumbnail'] && tags['Thumbnail'].image) {
                    //     var image = document.getElementById('thumbnail');
                    //     image.classList.remove('hidden');
                    //     image.src = 'data:image/jpg;base64,' + tags['Thumbnail'].base64;
                    // }

                    // Use the tags now present in `tags`.
                }).catch(function(error) {
                    // Handle error.
                });
            }
        })(window, document);
    </script>
@endsection
