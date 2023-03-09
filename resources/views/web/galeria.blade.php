<div class="child-page-listing">
    <div class="col-12 mt-4 mb-4">
        <label class="titleSection col-12">{{ $result['description'] }}</label>
        @if(!$result['isCoverPhoto'])
            <label class="dataSsection col-12" for="">12/09/2022  (10 imágenes)</label>
        @endif
    </div>
    <div class="row d-flex justify-content-between">

        <a @if($result['isCoverPhoto']) href="/album/Ana Bárbara, Presenta Bandidos Tours en el Auditorio Nacional" @else href="/comprar" target="_blank" @endif class="contentImgGeneral contentImgWibe">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM73877561_-960x640.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Ana Bárbara, Presenta Bandidos Tours en el Auditorio Nacional</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Angelique Boyer" @else href="/comprar" target="_blank" @endif class="contentImgGeneral contentImgLong">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM72847458_-960x1440.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Angelique Boyer</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Alfombra de la Nueva Película Maquíllame Otra Vez" @else href="/comprar" @endif class="contentImgGeneral contentImgLong">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM58296003_-960x1440.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Alfombra de la Nueva Película Maquíllame Otra Vez</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Pepe Aguilar Presenta Jaripeo Sin Fronteras en la Plaza de Toros México" @else href="/comprar" @endif class="contentImgGeneral contentImgWibe">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM72007374_-960x640.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Pepe Aguilar Presenta Jaripeo Sin Fronteras en la Plaza de Toros México</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Celebridades en la Alfombra Roja de la Serie La Cabeza de Joaquín Murrieta" @else href="/comprar" @endif class="contentImgGeneral contentImgWibe">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM70107184_-960x640.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Celebridades en la Alfombra Roja de la Serie “La Cabeza de Joaquín Murrieta”</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Manoella Torres se Presentará en el Lunario del Auditorio de la CDMX" @else href="/comprar" @endif class="contentImgGeneral contentImgLong">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/AMC54385612_-960x1440.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Manoella Torres se Presentará en el Lunario del Auditorio de la CDMX</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Susana Zavaleta Participará en un Recital con el Tenor Andrea Bocelli" @else href="/comprar" @endif class="contentImgGeneral contentImgWibe">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/01/ENTREFAM50305204_-960x640.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Susana Zavaleta Participará en un Recital con el Tenor Andrea Bocelli</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Conferencia de Prensa con Jesse & Joy por su Próxima Participación en el Auditorio Nacional" @else href="/comprar" @endif class="contentImgGeneral contentImgLong">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/AMC54255599_-960x1440.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Conferencia de Prensa con Jesse & Joy por su Próxima Participación en el Auditorio Nacional</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Coque Muñiz en Conferencia por su Presentación en el Lunario" @else href="/comprar" @endif class="contentImgGeneral contentImgWibe">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/AMC54505624_-960x640.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Coque Muñiz en Conferencia por su Presentación en el Lunario</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Fallece Polo Polo a los 78 Años de Edad" @else href="/comprar" @endif class="contentImgGeneral contentImgLong">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/01/AMC_20150325_3774-960x1373.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Fallece Polo Polo a los 78 Años de Edad</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Alfombra Roja de la Película Infelices Para Siempre" @else href="/comprar" @endif class="contentImgGeneral contentImgLong">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/01/ENTREFAM43494523_-960x1440.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Alfombra Roja de la Película Infelices Para Siempre</label>
            </div>
        </a>

        <a @if($result['isCoverPhoto']) href="/album/Enrique Guzmán Presenta su Disco Titulado Soy Yo" @else href="/comprar" @endif class="contentImgGeneral contentImgWibe">
            <img class="imgAlbum" src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM51515325_-960x640.jpg" alt="">
            @if($result['isCoverPhoto'])
                <div class="contentNumberImage col-12 row">
                    <label class="numberImage col-12" for=""><img class="iconNumberPhotos" src="{{ asset('icons/imageIcon.png') }}" alt=""> 10 imágenes</label>
                </div>
            @endif
            <div class="contentInfoAlbum column">
                <label class="titleAlbum col-sm-12" for="">16-02-2023</label>
                <label class="titleAlbum col-sm-12" for="">Enrique Guzmán Presenta su Disco Titulado Soy Yo</label>
            </div>
        </a>
    </div>
  </div>
