<style>
    .imageShopping {
        width: auto;
        height: 120px;
    }

    .contentCursor {
        cursor: pointer;
    }
</style>
@extends('layout.app')
@section('content')
    <div class="grid grid-cols-2  justify-content-between mt-4">
        <div>
            <h3 class="titleSection col-5 font-bold text-lg ">Carrito de compra</h3>
        </div>
        @if ($result['imageDownloads'] != null)
            <div class="col-start-3">
                <button type="button"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4
                focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
                    id="btnDownload">Descargar <i class="fa-solid fa-file-arrow-down"></i></button>
            </div>
        @endif
    </div>
    @if ($result['imageDownloads'] != null)
        <div class="grid grid-cols-3 mt-3 mb-3 ">
            <div class="">
                <select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    aria-label="Default select example" id="selectImageSize">
                    <option selected>Selecciona un tamaño</option>
                    <option value="1">Pequeña</option>
                    <option value="2">Mediana</option>
                    <option value="3">Grande</option>
                </select>
            </div>
            <div class="text-center">
                <p>Tiene
                    <span class="font-bold">{{ $result['count_cart'] }}</span>
                    descargas disponibles
                </p>
            </div>

            <div class="text-end">
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                    type="checkbox" name="" id="checkSelectAll">
                <label for="checkSelectAll cursor-pointer" class="mx-3"> Seleccionar todas la imágenes</label>
            </div>


        </div>
        <div class="grid grid-cols-1 mt-4">
            @foreach ($result['imageDownloads'] as $image)
                <div class="contentCursor grid grid-cols-4 border-solid border-2 border-gray-30 rounded-lg mb-2 p-4"
                    onclick="toggleCheckbox('checkSelected{{ $loop->index }}');">
                    <div style="width:40px" class="d-flex justify-content-center align-items-center">
                        <input class="form-check-input cursor-pointer mt-0 checkSelected" type="checkbox" value=""
                            id="checkSelected{{ $loop->index }}" data-id="{{ $image->id }}"
                            data-width="{{ $image->image_with }}" data-height="{{ $image->image_height }}">
                    </div>
                    <div class="col col-2 d-flex justify-content-center align-items-center">
                        <img class="imageShopping"
                            src="@if ($image->optimice_path != null) {{ $image->optimice_path }} @else {{ $image->image_path }} @endif"
                            alt="">
                    </div>
                    <div class="col-span-2">
                        <h5 class="">{{ $image->album_name }}</h5>
                        <p class="mt-4 font-light">
                            @if ($image->updated_at == null)
                                {{ $image->created_at }}
                            @else
                                {{ $image->updated_at }}
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="grid grid-cols-1 border-solid border-2 border-gray-200 text-center p-2 font-bold rounded-lg">
            <h5 class="m-4">Sin imágenes en el carrito de compras</h5>
        </div>
    @endif

@endsection
@section('js')
    <script>
        function cargando() {
            let timerInterval
            Swal.fire({
                title: 'Cargando',
                html: 'Esto tardara unos <b></b> millisegundos.',
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

                }
            })
        }
    </script>
    <script>
        var checkSelectAll = document.getElementById('checkSelectAll'); // Obtener el checkbox "Seleccione Todos"
        var checkboxes = document.getElementsByClassName(
            'checkSelected'); // Obtener todos los checkboxes generados en el bucle

        checkSelectAll.addEventListener('change', function() {
            var isChecked = checkSelectAll.checked; // Obtener el estado del checkbox "Seleccione Todos"

            // Marcar o desmarcar todos los checkboxes generados en el bucle
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = isChecked;
            }
        });

        function toggleCheckbox(checkboxId) {
            var checkbox = document.getElementById(checkboxId);
            checkbox.checked = !checkbox.checked;
        }

        document.getElementById('btnDownload').addEventListener('click', function() {

            const selectedIndex = document.getElementById('selectImageSize')
            console.log(selectedIndex.selectedIndex)

            if (selectedIndex.selectedIndex <= 0) {
                Toast.fire({
                    icon: 'info',
                    title: 'Selecciona un tamaño.'
                })
                return
            }

            var checkboxes = document.getElementsByClassName('checkSelected')
            var selectedImages = [];

            for (var i = 0; i < checkboxes.length; i++) {

                if (!checkboxes[i].checked) {
                    continue
                }

                var imageId = checkboxes[i].getAttribute('data-id')
                var imageWidth = checkboxes[i].getAttribute('data-width')
                var imageHeight = checkboxes[i].getAttribute('data-height')

                if (selectedIndex.selectedIndex == 1) {
                    if (imageWidth <= imageHeight) {
                        imageWidth = 396
                        imageHeight = 594
                    } else {
                        imageWidth = 594
                        imageHeight = 396
                    }
                } else if (selectedIndex.selectedIndex == 2) {
                    if (imageWidth <= imageHeight) {
                        imageWidth = 683
                        imageHeight = 1024
                    } else {
                        imageWidth = 1024
                        imageHeight = 683
                    }
                }


                selectedImages.push({
                    id: imageId,
                    width: imageWidth,
                    height: imageHeight
                });

            }
            cargando();
            sendImagesToDownloads(selectedImages);

        });

        function sendImagesToDownloads(listImages) {
            console.log("Mis imágenes")
            console.log(listImages); // Aquí puedes realizar la lógica para descargar las imágenes seleccionadas
            const data = {
                images: listImages
            };
            const url = "<?= URL('/downloadImagesArray') ?>";
            $.ajax({
                url: url, // Reemplaza 'ruta-del-controlador' por la URL del controlador Laravel
                type: 'POST', // Cambia 'POST' por el método HTTP que corresponda (GET, POST, PUT, DELETE, etc.)
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    new Promise((resolver, rechazar) => {
                            console.log('Inicial');
                            window.location.href = response.url
                            resolver();
                        })
                        .then(() => {
                            Swal.fire(
                                'Buen trabajo',
                                'Imágen descargada exitosamente',
                                'success'
                            )

                            location.reload();
                        })
                        .catch(() => {
                            Swal.fire(
                                'Ups...',
                                'Error al descargar la imágen, vuelve a intentarlo',
                                'error'
                            ).then(() => {
                                location.reload();
                            });
                        })
                    console.log(response);
                },
                error: function(response) {
                    Swal.fire(
                        'Ups...',
                        'Error al descargar la imágen',
                        'error'
                    ).then(() => {
                        location.reload();
                    });
                },
            });
        }
    </script>
@endsection
