<style>
.imgAlbumCarrito{
    object-fit: contain;
}

.optionsButtons{
    width: 100px;
}

.optionsText{
 font-size: 25px;
}

.contentImage{
    position: relative;
    display: inline-block;
    overflow: hidden;
}

.contentLogo{
    position: absolute;
    width: 85%;
    height: 90%;
}

.btnButtonsNextAndBefore{
    position: absolute;
    width: 100%;
    height: 100%;
}

.arrowsImages{
    cursor: pointer;
    opacity: .7;
    padding: 10px;
    background-color: rgba(150, 150, 150, .9);
    border: 5px
}

</style>
@extends('layout.app')
@section('content')
    <h3 class="titleSection mt-4 mb-4 col-12">{{ $result['dataAlbum']->album_name }}</h3>
    <div class="row d-flex justify-content-between">
        <div class="col-md-7 d-flex justify-content-center align-items-start">
            <div id="sizeImage" class="contentImage d-flex justify-content-center align-items-center @if($result['photo']->image_height > $result['photo']->image_with) col-8 @else col-12 @endif">
                <img class="imgAlbumCarrito col-12" id="mainImage" src="@if(@result['photo']->optimice_path != null) {{ $result['photo']->optimice_path }} @else {{ $result['photo']->image_path }} @endif" alt="">
                <div class="row contentLogo d-flex justify-content-center align-items-center">
                    <div class="@if($result['isWideImage']) col-7 @else col-10 @endif"><img class="col-12" src="{{ asset('images/marca-agua.png') }}" alt=""></div>
                    <div class="@if($result['isWideImage']) col-7 @else col-10 @endif"><img class="col-12" src="{{ asset('images/marca-agua.png') }}" alt=""></div>
                    <div class="@if($result['isWideImage']) col-7 @else col-10 @endif"><img class="col-12" src="{{ asset('images/marca-agua.png') }}" alt=""></div>
                </div>
                <div class="btnButtonsNextAndBefore d-flex justify-content-between">
                    <div class="d-flex align-items-center"><img onclick="selectImageForArrow(false)" class="arrowsImages rounded" src="{{ asset('icons/flecha-izquierda.png') }}" alt=""></div>
                    <div class="d-flex align-items-center"><img onclick="selectImageForArrow(true)" class="arrowsImages rounded" src="{{ asset('icons/flecha-correcta.png') }}" alt=""></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 column bg-light p-4 rounded-4 border border-1">
            <h5 class="col-12">Tamaño de la imágen</h5>
            <div class="form-check mt-2 d-flex align-items-center">
                <input class="form-check-input" type="radio" name="flexRadioDefault" value="small" id="flexRadioDefault1">
                <label class="form-check-label optionsText" for="flexRadioDefault1">&nbsp;&nbsp;Pequeña <label id="dimensionsSmall">{{$result['imageDimensions']->smallWith}} X {{$result['imageDimensions']->smallHeight}}</label></label>
            </div>
            <div class="form-check mt-2 d-flex align-items-center">
                <input class="form-check-input" type="radio" name="flexRadioDefault" value="medium" id="flexRadioDefault2" checked>
                <label class="form-check-label optionsText" for="flexRadioDefault2">&nbsp;&nbsp;Mediana <label id="dimensionsMedium">{{$result['imageDimensions']->mediumWith}} X {{$result['imageDimensions']->mediumHeight}}</label></label>
            </div>
            <div class="form-check mt-2 mb-3 d-flex align-items-center">
                <input class="form-check-input" type="radio" name="flexRadioDefault" value="big" id="flexRadioDefault3" checked>
                <label class="form-check-label optionsText" for="flexRadioDefault3">&nbsp;&nbsp;Grande <label for="" id="imageWith">{{ $result['photo']->image_with }}</label> X <label for="" id="imageHeight">{{ $result['photo']->image_height }}</label></label>
            </div>
            <div class="col-12 mb-3 p-2">
                <button onclick="@if($result['generalData']['isLogin']) acceptAddImageOrDeniedImage({!!$result['generalData']['userData']->max_download_numbers!!}, true) @else permissionDenied() @endif" class="col-11 btn btn-danger p-2 mb-3">Añadir al carrito</button>
                <button onclick="@if($result['generalData']['isLogin']) acceptAddImageOrDeniedImage({!!$result['generalData']['userData']->max_download_numbers!!}, false) @else permissionDenied() @endif" class="col-11 btn btn-danger p-2">Descargar imágen</button>
            </div>
            <h2 class="">Encabezado</h2>
            <h2 class="text-muted" id="id">ID: {{ $result['photo']->id }}</h2>
            <h4 class="text-muted" id="date">Fecha: {{ $result['photo']->created_at }}</h4>
            <p class="text-muted mt-5 mb-5" id="imageDescription">@if(isset($result['photo']->image_info->ImageDescription)){{ $result['photo']->image_info->ImageDescription }} @else {{ $result['photo']->image_info->IFD0->ImageDescription }} @endif</p>
        </div>
    </div>
    @include('web/galeria')
@endsection
<script>
    window.onload = initPage();

    function permissionDenied(){
        alert('Para descargar o guardar una imágen al carrito necesita iniciar sesión')
    }

    function limitToDownloads(){
        alert('A llegado al límite de desacargas permitido')
    }

    function acceptAddImageOrDeniedImage(maxNumberImage, optionOperation){
        var numberImageDown = JSON.parse(localStorage.getItem("numberImageCar"))
        console.log(numberImageDown + " " + maxNumberImage + " " + optionOperation)
        
        if(numberImageDown < maxNumberImage){
            addImageToCart(optionOperation)
        }else{
            limitToDownloads()
        }
    }

    function selectImage(image){

        console.log("Select Image: "+image.id)
        image.image_info = JSON.parse(image.image_info)
        let dimensionsSmall
        let dimensionsMedium

        var imageContent = document.getElementById("sizeImage")
        imageContent.classList.remove("col-12")
        imageContent.classList.remove("col-8")

        if(parseInt(image.image_with) >= parseInt(image.image_height)){
            dimensionsSmall = "594 X 396"
            dimensionsMedium = "1024 X 683"
            imageContent.classList.add("col-12");
        }else{
            dimensionsSmall = "396 X 594"
            dimensionsMedium = "683 X 1024"
            imageContent.classList.add("col-8");
        }

        document.getElementById('mainImage').src = image.image_path
        document.getElementById('imageWith').innerHTML = image.image_with
        document.getElementById('imageHeight').innerHTML = image.image_height
        document.getElementById('id').innerHTML = 'ID: '+image.id
        document.getElementById('date').innerHTML = 'Fecha: '+image.created_at
        document.getElementById('imageDescription').innerHTML = image.image_info.ImageDescription
        document.getElementById('dimensionsSmall').innerHTML = dimensionsSmall
        document.getElementById('dimensionsMedium').innerHTML = dimensionsMedium

        localStorage.setItem("idMainImage", JSON.stringify(image.id))
        localStorage.setItem("withMainImage", JSON.stringify(image.image_with))
        localStorage.setItem("heightMainImage", JSON.stringify(image.image_height))
        window.scrollTo({
            top: 0,
            behavior: "smooth" // Opcional: anima el desplazamiento
        });
    }

    function selectImageForArrow(isNext){
        console.log("Start select image")
        let idCurrentImage = JSON.parse(localStorage.getItem("idMainImage"))
        let listImages = JSON.parse(localStorage.getItem("ListImages"))

        for(let i=0; i<=listImages.length-1; i++){
            if(listImages[i].id == idCurrentImage){
                if(isNext){
                    selectImage(listImages[i+1])
                }else{
                    selectImage(listImages[i-1])
                }
                break
            }
        }
    }

    function addImageToCart(addToCar){
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

        if(parseInt(withMainImage) >= parseInt(heightMainImage)){
            if(value == 'small'){
                requestWith = 594
                requestHeight = 396
            }else if(value == 'medium'){
                requestWith = 1024
                requestHeight = 683
            }else if(value == 'big'){
                requestWith = parseInt(withMainImage)
                requestHeight = parseInt(heightMainImage)
            }
        }else{
            if(value == 'small'){
                requestWith = 396
                requestHeight = 594
            }else if(value == 'medium'){
                requestWith = 683
                requestHeight = 1024
            }else if(value == 'big'){
                requestWith = parseInt(withMainImage)
                requestHeight = parseInt(heightMainImage)
            }
        }

        if(addToCar){
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
                    alert('Imagen añadida al carrito')
                    const numberImageDown = JSON.parse(localStorage.getItem("numberImageCar"))
                    const NewnumberImageDown = numberImageDown + 1
                    localStorage.setItem("numberImageCar", JSON.stringify(NewnumberImageDown))

                    //var numberCar = document.getElementById('numberImageCar').textContent = numberImageDown
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }else{
            console.log("Data:  "+value+" "+requestWith+" "+requestHeight)
            //window.location.href = "{{ route('addPhotoCookies', [':idImage', ':requestWith', ':requestHeight']) }}".replace(':idImage', idCurrentImage).replace(':requestWith', requestWith).replace(':requestHeight', requestHeight);
            const numberImageDown = JSON.parse(localStorage.getItem("numberImageCar"))
            const NewnumberImageDown = numberImageDown + 1
            localStorage.setItem("numberImageCar", JSON.stringify(NewnumberImageDown))


            var url = "{{ route('addPhotoCookies', ['idImage' => ':idImage', 'requestWith' => ':requestWith', 'requestHeight' => ':requestHeight']) }}";
            url = url.replace(':idImage', idCurrentImage).replace(':requestWith', requestWith).replace(':requestHeight', requestHeight);
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

    function initPage(){
        var numberImageCar = {!! $result['generalData']['numberImageDownloadsUser'] !!}
        localStorage.setItem("ListImages", JSON.stringify({!! $result['photos'] !!}))
        localStorage.setItem("idMainImage", JSON.stringify({!! $result['photo']->id !!}))
        localStorage.setItem("numberImageCar", JSON.stringify(numberImageCar))
        localStorage.setItem("withMainImage", JSON.stringify({!! $result['photo']->image_with !!}))
        localStorage.setItem("heightMainImage", JSON.stringify({!! $result['photo']->image_height !!}))
    }

</script>
