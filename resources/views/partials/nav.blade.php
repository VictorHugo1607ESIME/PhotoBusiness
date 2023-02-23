<nav class="col-12 navbar row d-flex justify-content-between mb-4">
    <div class="col-sm-10 col-md-2 d-flex justify-content-start">
        <a href="/"><img class="col-sm-12" src="{{ asset('images/logo-entrefam.jpeg') }}"></a>
    </div>
    <div class="container-fluid col-md-4 justify-content-center">
      <form class="d-flex col-12" role="search">
        <input class="form-control me-2 col-8" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-danger" onmouseover="changeIconSearchWhite()" onmouseout="changeIconSearch()" type="submit"><img id="search_icon" src="{{ asset('icons/lupa.png') }}"    /></button>
      </form>
    </div>
    <div class="row col-md-3 d-flex justify-content-between align-items-center">
        <a class="col-4 text-dark" href="/collections">Colecciones</a>
        <button class="btn btn-outline-danger col-4" type="submit">Contacto</button>
        <a type="button" class="text-danger col-md-3 d-flex justify-content-end" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Log In</a>
    </div>
</nav>
