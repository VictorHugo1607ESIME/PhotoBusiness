<nav class="col-12 navbar columns">
    <div class="col-12 row d-flex justify-content-between">
        <div class="col-sm-10 col-md-2 d-flex justify-content-start">
            <a href="/"><img class="col-sm-12" src="{{ asset('images/logo-entrefam.jpeg') }}"></a>
        </div>
        <div class="container-fluid col-md-6 justify-content-center">
            <form class="d-flex col-12" role="search">
                <input class="form-control me-2 col-8" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-danger" onmouseover="changeIconSearchWhite()" onmouseout="changeIconSearch()" type="submit"><img id="search_icon" src="{{ asset('icons/lupa.png') }}"    /></button>
            </form>
        </div>
        <div class="row @if($result['generalData']['isLogin']) col-md-2 @else col-md-3 @endif  d-flex justify-content-end align-items-center">
            <a class="btn btn-outline-danger col-md-7" href="/contact">Contacto</a>
            @if(!$result['generalData']['isLogin'])
                <a type="button" class="text-danger col-md-4 d-flex justify-content-end" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Log In</a>
            @endif
        </div>
    </div>
    <div class="col-12 row d-flex justify-content-between mt-2 mb-2">
        <div class="col-4"></div>
        <div class="col-4 d-flex justify-content-center">
            <a class="col-md-3 menuOptions @if($result['page'] == 'home') selectMenuOptions @else text-dark @endif d-flex justify-content-start" href="/">Inicio</a>
            <a class="col-md-3 menuOptions @if($result['page'] == 'collections') selectMenuOptions @else text-dark @endif d-flex justify-content-start" href="/collections">Colecciones</a>
        </div>
        <div class="col-4 d-flex justify-content-end">
            <label for="">(1) <img src="{{ asset('icons/carrito-de-compras.png') }}"></label>
        </div>
    </div>
</nav>
