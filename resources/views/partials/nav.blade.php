<nav class="col-12 navbar row d-flex justify-content-between mb-4">
    <div class="col-sm-10 col-md-3 d-flex justify-content-start">
        <img class="col-sm-12 col-md-8" src="{{ asset('images/logo-entrefam.jpeg') }}">
    </div>
    <div class="container-fluid col-md-3 justify-content-center">
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-danger" onmouseover="changeIconSearchWhite()" onmouseout="changeIconSearch()" type="submit"><img id="search_icon" src="{{ asset('icons/lupa.png') }}"    /></button>
      </form>
    </div>
    <div class="col-md-3 d-flex justify-content-end">
        <button class="btn btn-outline-danger" type="submit">Contacto</button>
    </div>
</nav>
