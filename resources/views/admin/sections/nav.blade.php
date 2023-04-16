    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 " style="background-color:  #2e4053 ">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <div class="m-1 p-1" style="max-width: 100%">
                    <img src="{{asset('images/logo-entrefam.jpeg')}}" alt="Logo" style="max-width: 100%" >
                </div>
                <a href="/"
                    class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Administrador</span>
                </a>
                
                @include('admin.sections.menu')
                <hr>
                <div class="dropdown pb-4">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu2">
                        <li>
                            <a href="{{ URL('/admin/logout') }}" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> <span
                                    class="ms-1 d-none d-sm-inline">Cerrar sesión</span></a>
                        </li>
                    </ul>
                    {{-- <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                       
                        <span class="d-none d-sm-inline mx-1">Acciones</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
        <div class="col py-3">
            <x-breadcrumb :data="isset($result['breadcrumb']) ? $result['breadcrumb'] : null" />
            @if (session('success'))
                <x-alert-success></x-alert-success>
            @endif
            @if (session('error'))
                <x-alert-error></x-alert-error>
            @endif
            @yield('content')
        </div>
    </div>
