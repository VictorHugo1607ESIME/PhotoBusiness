<style>
    .imageShopping{
        width: auto;
        height: 120px;
    }

    .contentCursor{
        cursor: pointer;
    }
</style>
@extends('layout.app')
@section('content')
<div class="col-12 d-flex justify-content-between mt-4">
    <h3 class="titleSection col-5">Carrito de compra</h3>
    @if($result['imageDownloads'] != null)
        <button type="button" class="btn btn-danger" id="btnDownload">Descargar</button>
    @endif
</div>
@if($result['imageDownloads'] != null)
    <div class="col-12 mt-3 mb-3 row">
        <div class="col-3">
            <select class="form-select" aria-label="Default select example" id="selectImageSize">
                <option selected>Selecciona un tamaño</option>
                <option value="1">Pequeña</option>
                <option value="2">Mediana</option>
                <option value="3">Grande</option>
              </select>
        </div>
        <div class="col-4 d-flex align-items-center">
            <p>Tiene <label>{{ $result['generalData']['userData']->max_download_numbers - $result['generalData']['userData']->download_numbers }}</label> descargas disponibles</p>
        </div>

        <div class="mt-3 d-flex align-items-center">
            <input class="form-check-input mt-0" type="checkbox" name="" id="checkSelectAll"> 
            <label for="checkSelectAll" class="mx-3"> Seleccionar todas la imágenes</label>
        </div>
        

    </div>
    <div class="col-12 mt-4">
        @foreach($result['imageDownloads'] as $image)
        <div class="contentCursor col-12 row rounded-4 border border-2 mb-2 p-2" onclick="toggleCheckbox('checkSelected{{$loop->index}}');">
            <div style="width:40px" class="d-flex justify-content-center align-items-center">
                <input class="form-check-input mt-0 checkSelected" type="checkbox" value="" id="checkSelected{{$loop->index}}"
                data-id="{{$image->id}}"
                data-width="{{$image->image_with}}"
                data-height="{{$image->image_height}}">
            </div>
            <div class="col col-2 d-flex justify-content-center align-items-center">
                <img class="imageShopping" src="@if($image->optimice_path != null) {{$image->optimice_path}} @else {{$image->image_path}} @endif" alt="">
            </div>
            <div class="col">
                <h5>{{ $image->album_name }}</h5>
                <p>@if($image->updated_at == null) {{ $image->created_at }} @else {{ $image->updated_at }} @endif</p>
            </div>
        </div>
        @endforeach
    </div>
@else
    <h5 class="col-12 d-flex justify-content-center mt-4">Sin imágenes en el carrito de compras</h5>
@endif
<script>

    var checkSelectAll = document.getElementById('checkSelectAll'); // Obtener el checkbox "Seleccione Todos"
    var checkboxes = document.getElementsByClassName('checkSelected'); // Obtener todos los checkboxes generados en el bucle

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

        if(selectedIndex.selectedIndex <= 0){
            alert("Seleccione un tamaña de imágen")
            return 
        }

        var checkboxes = document.getElementsByClassName('checkSelected')
        var selectedImages = [];

        for (var i = 0; i < checkboxes.length; i++) {

            if(!checkboxes[i].checked){
                continue
            }

            var imageId = checkboxes[i].getAttribute('data-id')
            var imageWidth = checkboxes[i].getAttribute('data-width')
            var imageHeight = checkboxes[i].getAttribute('data-height')

            if(selectedIndex.selectedIndex == 1){
                if(imageWidth <= imageHeight){
                    imageWidth = 396
                    imageHeight = 594
                }else{
                    imageWidth = 594
                    imageHeight = 396
                }
            }else if(selectedIndex.selectedIndex == 2){
                if(imageWidth <= imageHeight){
                    imageWidth = 683
                    imageHeight = 1024
                }else{
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
        sendImagesToDownloads(selectedImages)

    });

    function sendImagesToDownloads(listImages){
        console.log(listImages); // Aquí puedes realizar la lógica para descargar las imágenes seleccionadas
        const data = {
          images: listImages
        };
        const url = "<?= URL('/downloadImagesArray') ?>";
        $.ajax({
            url: url, // Reemplaza 'ruta-del-controlador' por la URL del controlador Laravel
            type: 'POST', // Cambia 'POST' por el método HTTP que corresponda (GET, POST, PUT, DELETE, etc.)
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: data,
            success: function(response) {
                 new Promise((resolver, rechazar) => {
                    console.log('Inicial');
                    window.location.href = response.url
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
                console.log(response);
            },
        });
    }

</script>
@endsection
