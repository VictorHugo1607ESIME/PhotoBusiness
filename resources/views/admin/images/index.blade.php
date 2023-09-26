@extends('admin.layout.app2')
@section('css')
    <style>
        .select-none {
            color: blue !important;
        }
    </style>
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-4 text-end">
        <div>
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2
                dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 images_titule"
                type="button"> Procesar Imagene Sin titulo</button>
        </div>
        {{-- <button type="button" id="sync_ftp" class="btn btn-success" style="color: black">Sincronizar FTP</button> --}}
    </div>
    <div class="row justify-content-start" id="div_image">

        @livewire('images-table')
        {{-- @if (!empty($result['images'])) --}}
        {{-- @foreach ($result['images'] as $item)
            <div class="col p-2 text-center">
                <x-card-img url="{{ asset($item->optimice_path) }}" alt="{{ $item->image_name }}" id="{{ $item->id }}" />
            </div>
        @endforeach --}}
        {{-- @endif --}}
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/exifreader@4.13.0/dist/exif-reader.min.js"></script>
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
