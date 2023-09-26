@extends('admin.layout.app2')
@section('content')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/exifreader@4.13.0/dist/exif-reader.min.js"></script>
    <script>
        var imagen = "";
        var id = "";
        /* This Source Code Form is subject to the terms of the Mozilla Public
         * License, v. 2.0. If a copy of the MPL was not distributed with this
         * file, You can obtain one at https://mozilla.org/MPL/2.0/. */


        (function(window, document) {
            'use strict';

            if (!supportsFileReader()) {
                alert('Sorry, your web browser does not support the FileReader API.');
                return;
            }


            // window.addEventListener('load', function() {
            //     document.querySelector('form').addEventListener('submit', handleSubmit, false);
            // }, false);

            console.log(imagen);
            datos();

            function supportsFileReader() {
                return window.FileReader !== undefined;
            }

            function datos() {
                $.ajax({
                    type: "get",
                    url: "<?= URL('/getimageInfo') ?>",
                    dataType: "JSON",
                    success: function(res) {
                        imagen = res.image;
                        id = res.id;
                        handleSubmit(imagen, id);
                        supportsFileReader();

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
                            location.reload();
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
