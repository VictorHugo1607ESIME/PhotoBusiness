<style>
    .imgAlbumCarrito {
        object-fit: contain;
    }

    .optionsButtons {
        width: 100px;
    }

    .optionsText {
        font-size: 25px;
    }

    .contentImage {
        position: relative;
        display: inline-block;
        overflow: hidden;
    }

    .contentLogo {
        position: absolute;
        width: 85%;
        height: 90%;
    }

    .btnButtonsNextAndBefore {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .arrowsImages {
        cursor: pointer;
        opacity: .7;
        padding: 10px;
        background-color: rgba(150, 150, 150, .9);
        border: 5px
    }
</style>
@extends('layout.app')
@section('content')
    <div class="grid grid-cols-5 gap-4 mb-4">
        <div class="col-span-3 col-start-2 text-center">
            <h3 class="font-bold text-2xl">{{ $result['dataAlbum']->album_name }}</h3>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-2 gap-4">
            <div id="sizeImage"
                class="contentImage flex justify-center align-center border-solid border-2 border-gray-300 rounded-xl">
                @if ($result['photo']->image_with > $result['photo']->image_height)
                    <img class="imgAlbumCarrito " id="mainImage" style="width: 720px; height: 480px; object-fit: scale-down; "
                        src="{{ $result['photo']->optimice_path != null ? $result['photo']->optimice_path : $result['photo']->image_path }}"
                        alt="">
                @else
                    <img class="imgAlbumCarrito " id="mainImage"
                        style="width: 720px; height: 480px; object-fit: scale-down;"
                        src="{{ $result['photo']->optimice_path != null ? $result['photo']->optimice_path : $result['photo']->image_path }}"
                        alt="">
                @endif

                <div class="row contentLogo d-flex justify-content-center align-items-center">
                    <div class="@if ($result['isWideImage']) col-7 @else col-10 @endif"><img class="col-12"
                            src="{{ asset('images/marca-agua.png') }}" alt=""></div>
                    <div class="@if ($result['isWideImage']) col-7 @else col-10 @endif"><img class="col-12"
                            src="{{ asset('images/marca-agua.png') }}" alt=""></div>
                    <div class="@if ($result['isWideImage']) col-7 @else col-10 @endif"><img class="col-12"
                            src="{{ asset('images/marca-agua.png') }}" alt=""></div>
                </div>
                <div class="btnButtonsNextAndBefore flex justify-between items-center" style="width: 100%; height: 100%;">
                    <div><img onclick="selectImageForArrow(false)" class="arrowsImages rounded"
                            style="width: 75px;height: 75px;" src="{{ asset('icons/flecha-izquierda.png') }}"
                            alt="">
                    </div>
                    <div><img onclick="selectImageForArrow(true)" class="arrowsImages rounded"
                            style="width: 75px;height: 75px;" src="{{ asset('icons/flecha-correcta.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="block  p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 text-lg">
                <h5 class="text-xl">Tamaño de la imágen</h5>
                <div class="form-check mt-2 d-flex align-items-center text-lg cursor-pointer">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" value="small"
                        id="flexRadioDefault1">
                    <label class="form-check-label optionsText" for="flexRadioDefault1">&nbsp;&nbsp;Pequeña <label
                            id="dimensionsSmall">{{ $result['imageDimensions']->smallWith }} X
                            {{ $result['imageDimensions']->smallHeight }}</label></label>
                </div>
                <div class="form-check mt-2 d-flex align-items-center text-lg cursor-pointer">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" value="medium"
                        id="flexRadioDefault2" checked>
                    <label class="form-check-label optionsText" for="flexRadioDefault2">&nbsp;&nbsp;Mediana <label
                            id="dimensionsMedium">{{ $result['imageDimensions']->mediumWith }} X
                            {{ $result['imageDimensions']->mediumHeight }}</label></label>
                </div>
                <div class="form-check mt-2 mb-3 d-flex align-items-center text-lg cursor-pointer">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" value="big"
                        id="flexRadioDefault3" checked>
                    <label class="form-check-label optionsText" for="flexRadioDefault3">&nbsp;&nbsp;Grande <label
                            for="" id="imageWith">{{ $result['photo']->image_with }}</label> X <label
                            for="" id="imageHeight">{{ $result['photo']->image_height }}</label></label>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-end">
                        <button
                            onclick="@if ($result['generalData']['isLogin']) acceptAddImageOrDeniedImage({!! $result['generalData']['userData']->max_download_numbers !!}, true) @else permissionDenied() @endif"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 ">Añadir
                            al carrito</button>
                    </div>
                    <div>
                        <button
                            onclick="@if ($result['generalData']['isLogin']) acceptAddImageOrDeniedImage({!! $result['generalData']['userData']->max_download_numbers !!}, false) @else permissionDenied() @endif"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"><i
                                class="fa-solid fa-download"></i> Descargar
                            imágen</button>
                    </div>
                </div>
                <h2 class="text-xl font-bold">Encabezado</h2>
                <h2 class="text-muted" id="id">ID: {{ $result['photo']->id }}</h2>
                <h4 class="text-muted" id="date">Fecha: {{ $result['photo']->created_at }}</h4>
                <h4 class="font-bold">Titulo:<span id="title_img">{{ $result['photo']->image_title}}</span></h4>
                <p class="text-muted mt-5 mb-5" >
                    @if (isset($result['photo']->image_info->ImageDescription))
                        {{ $result['photo']->image_info->ImageDescription }}
                    @else
                        {{ $result['photo']->image_info->IFD0->ImageDescription }}
                    @endif
                </p>
            </div>
        </div>
        @include('web/galeria')
    @endsection
    @section('js')
        <script>
            window.onload = initPage();

            function permissionDenied() {
                alert('Para descargar o guardar una imágen al carrito necesita iniciar sesión')
            }

            function limitToDownloads() {
                alert('A llegado al límite de desacargas permitido')
            }

            function acceptAddImageOrDeniedImage(maxNumberImage, optionOperation) {
                var numberImageDown = JSON.parse(localStorage.getItem("numberImageCar"))
                console.log(numberImageDown + " " + maxNumberImage + " " + optionOperation)

                if (numberImageDown < maxNumberImage) {
                    addImageToCart(optionOperation)
                } else {
                    limitToDownloads()
                }
            }

            function selectImage(image) {
                Toast.fire({
  icon: 'info',
  title: 'Datos cargados'
});
                console.log(image);
                console.log("Select Image: " + image.id)
                image.image_info = JSON.parse(image.image_info)
                let dimensionsSmall
                let dimensionsMedium

                var imageContent = document.getElementById("sizeImage")
                imageContent.classList.remove("col-12")
                imageContent.classList.remove("col-8")

                if (parseInt(image.image_with) >= parseInt(image.image_height)) {
                    dimensionsSmall = "594 X 396"
                    dimensionsMedium = "1024 X 683"
                    imageContent.classList.add("col-12");
                } else {
                    dimensionsSmall = "396 X 594"
                    dimensionsMedium = "683 X 1024"
                    imageContent.classList.add("col-8");
                }

                document.getElementById('mainImage').src = image.image_path
                document.getElementById('imageWith').innerHTML = image.image_with
                document.getElementById('imageHeight').innerHTML = image.image_height
                document.getElementById('id').innerHTML = 'ID: ' + image.id
                document.getElementById('date').innerHTML = 'Fecha: ' + image.created_at
                document.getElementById('dimensionsSmall').innerHTML = dimensionsSmall
                document.getElementById('dimensionsMedium').innerHTML = dimensionsMedium
                document.getElementById('title_img').innerHTML = image.image_title

                localStorage.setItem("idMainImage", JSON.stringify(image.id))
                localStorage.setItem("withMainImage", JSON.stringify(image.image_with))
                localStorage.setItem("heightMainImage", JSON.stringify(image.image_height))
                window.scrollTo({
                    top: 0,
                    behavior: "smooth" // Opcional: anima el desplazamiento
                });
            }

            function selectImageForArrow(isNext) {
                console.log("Start select image")
                let idCurrentImage = JSON.parse(localStorage.getItem("idMainImage"))
                let listImages = JSON.parse(localStorage.getItem("ListImages"))

                for (let i = 0; i <= listImages.length - 1; i++) {
                    if (listImages[i].id == idCurrentImage) {
                        if (isNext) {
                            selectImage(listImages[i + 1])
                        } else {
                            selectImage(listImages[i - 1])
                        }
                        break
                    }
                }
            }

            function addImageToCart(addToCar) {
                console.log("Start add image car")
                var radios = document.querySelectorAll('input[type=radio][name=flexRadioDefault]')
                const idCurrentImage = JSON.parse(localStorage.getItem("idMainImage"))
                const withMainImage = JSON.parse(localStorage.getItem("withMainImage"))
                const heightMainImage = JSON.parse(localStorage.getItem("heightMainImage"))
                let value
                let requestWith
                let requestHeight

                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].checked) {
                        value = radios[i].value
                    }
                }

                if (parseInt(withMainImage) >= parseInt(heightMainImage)) {
                    if (value == 'small') {
                        requestWith = 594
                        requestHeight = 396
                    } else if (value == 'medium') {
                        requestWith = 1024
                        requestHeight = 683
                    } else if (value == 'big') {
                        requestWith = parseInt(withMainImage)
                        requestHeight = parseInt(heightMainImage)
                    }
                } else {
                    if (value == 'small') {
                        requestWith = 396
                        requestHeight = 594
                    } else if (value == 'medium') {
                        requestWith = 683
                        requestHeight = 1024
                    } else if (value == 'big') {
                        requestWith = parseInt(withMainImage)
                        requestHeight = parseInt(heightMainImage)
                    }
                }

                if (addToCar) {
                    let idPhoto = {!! $result['photo']->id !!}
                    let idAlbum = {!! $result['dataAlbum']->id !!}
                    console.log(idPhoto)
                    console.log(idAlbum)
                    let url = "/addImageToCart"

                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            idImage: idPhoto,
                            idAlbum: idAlbum
                        },
                        success: function(response) {
                            console.log(response);
                            $('#update_cart').trigger('click');
                            // alert('Imagen añadida al carrito')
                            const numberImageDown = JSON.parse(localStorage.getItem("numberImageCar"))
                            const NewnumberImageDown = numberImageDown + 1
                            localStorage.setItem("numberImageCar", JSON.stringify(NewnumberImageDown))

                            //var numberCar = document.getElementById('numberImageCar').textContent = numberImageDown
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    console.log("Data:  " + value + " " + requestWith + " " + requestHeight)
                    //window.location.href = "{{ route('addPhotoCookies', [':idImage', ':requestWith', ':requestHeight']) }}".replace(':idImage', idCurrentImage).replace(':requestWith', requestWith).replace(':requestHeight', requestHeight);
                    const numberImageDown = JSON.parse(localStorage.getItem("numberImageCar"))
                    const NewnumberImageDown = numberImageDown + 1
                    localStorage.setItem("numberImageCar", JSON.stringify(NewnumberImageDown))


                    var url =
                        "{{ route('addPhotoCookies', ['idImage' => ':idImage', 'requestWith' => ':requestWith', 'requestHeight' => ':requestHeight']) }}";
                    url = url.replace(':idImage', idCurrentImage).replace(':requestWith', requestWith).replace(':requestHeight',
                        requestHeight);
                    console.log(url)

                    new Promise((resolver, rechazar) => {
                            console.log('Inicial');
                            window.location.href = url
                            resolver();
                        })
                        .then(() => {
                            alert("Imágen descargada exitosamente")
                            console.log('Haz esto');
                        })
                        .catch(() => {
                            console.log('Haz aquello');
                            alert("Error al descargar la imágen")
                        })


                    /*$.ajax({
                        url: url, // Reemplaza 'ruta-del-controlador' por la URL del controlador Laravel
                        type: 'GET', // Cambia 'POST' por el método HTTP que corresponda (GET, POST, PUT, DELETE, etc.)
                        headers: {
                            'Content-Description': 'File Transfer',
                            'contentType': 'image/jpg'
                        },
                        success: function() {
                             // Código a ejecutar cuando la petición sea exitosa
                            console.log();
                        },
                        error: function(xhr) {
                             // Código a ejecutar si hay algún error en la petición
                            console.log("Error::: "+xhr.responseText);
                        }
                    });*/
                    /*fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'image/jpg'
                        }
                    })
                    .then(function(response) {
                        if (!response.ok) {
                            throw new Error('Error en la petición');
                        }
                        return response.json();
                    })
                    .then(function(responseData) {
                        console.log("Response::: "+responseData);
                    })
                    .catch(function(error) {
                        console.error("ErrorCatch::: "+error);
                    });*/

                }
            }

            function initPage() {
                var numberImageCar = {!! $result['generalData']['numberImageDownloadsUser'] !!}
                localStorage.setItem("ListImages", JSON.stringify({!! $result['photos'] !!}))
                localStorage.setItem("idMainImage", JSON.stringify({!! $result['photo']->id !!}))
                localStorage.setItem("numberImageCar", JSON.stringify(numberImageCar))
                localStorage.setItem("withMainImage", JSON.stringify({!! $result['photo']->image_with !!}))
                localStorage.setItem("heightMainImage", JSON.stringify({!! $result['photo']->image_height !!}))
            }
        </script>
    @endsection
