<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <script src="{{ asset('fontawesome\js\all.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/css/iziModal.min.css"
        integrity="sha512-3c5WiuZUnVWCQGwVBf8XFg/4BKx48Xthd9nXi62YK0xnf39Oc2FV43lIEIdK50W+tfnw2lcVThJKmEAOoQG84Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="gallery/css/grid-gallery.min.css"> --}}
    @include('layout.style')
    @yield('css')
    <title>Entrefam</title>
</head>

<body class="font-sans">
    <div class="container mx-auto">
        @livewire('nav-header')
    </div>

    <div class="container mx-auto bg-stone-200 py-4 rounded-lg border border-sky-100 mt-4">
        <div class="grid grid-cols-10 ">
            <div class="col-span-9 text-center">
                <a href="{{ url('/') }}" class=" text-red-600 font-bold hover:underline text-xl mr-4">Inicio</a>
                <a href="{{ url('/collections') }}"
                    class="text-back-600 font-bold hover:underline text-xl ml-4">Collecciones</a>
                @if (session('isLogin') == true)
                    <a href="{{ url('/exclusives') }}"
                        class="text-back-600 font-bold hover:underline text-xl ml-4">Exclusivas</a>
                @endif
            </div>
            <div class="text-center">
                @livewire('icon-card')
            </div>
        </div>
    </div>
    <div class="my-4">
        @yield('top')
    </div>
    <div class="container mx-auto min-h-screen mt-8">
        @yield('content')
    </div>

    <div class="container mx-auto my-6">
        <div class="grid grid-cols-3">
            <div>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div class="text-center">
                        <a target="_blank" href="https://www.facebook.com/entrefamsadecv/">
                            <i class="fa-brands fa-facebook fa-3x" style="color: #4267B2"></i>
                        </a>
                    </div>
                    <div class="text-center">
                        <a target="_blank" href="https://www.instagram.com/entrefamsadecv/?igshid=NTc4MTIwNjQ2YQ%3D%3D">
                            <i class="fa-brands fa-instagram fa-3x" style="color: #E1306C"></i>
                        </a>
                    </div>
                    <div class="text-center">
                        <a target="_blank" href=""><img class="iconSocialNetworks">
                            <i class="fa-brands fa-twitter fa-3x" style="color:#1DA1F2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="text-end">
                        <a href="{{ URL('/politicas') }}"
                            class=" text-black-600 font-bold hover:underline text-xl mr-4">Políticas de
                            privacidad</a>
                    </div>
                    <div class="text-start">
                        <a href="{{ url('/quienessomos') }}"
                            class=" text-black-600 font-bold hover:underline text-xl mr-4">Quiénes
                            somos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="modal_login">
        <!-- data-iziModal-fullscreen="true"  data-iziModal-title="Welcome"  data-iziModal-subtitle="Subtitle"  data-iziModal-icon="icon-home" -->
        <!-- Modal content -->
        @livewire('login')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/js/iziModal.min.js"
        integrity="sha512-lR/2z/m/AunQdfBTSR8gp9bwkrjwMq1cP0BYRIZu8zd4ycLcpRYJopB+WsBGPDjlkJUwC6VHCmuAXwwPHlacww=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="gallery/js/grid-gallery.min.js"></script> --}}
    @livewireScripts
    <script>
        $("#modal_login").iziModal({
            closeOnEscape: false,
            closeButton: false,
        });
        $(document).ready(function() {

            $(document).on('click', '.openLogin', function() {

                $('#email').val('');
                $('#password').val('');
                $('#modal_login').iziModal('open');
            });
        });
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
    <script>
        window.addEventListener('success', event => {
            Toast.fire({
                icon: 'success',
                title: event.detail.message != null ? event.detail.message : 'Proceso realizado.'
            });
        });
        window.addEventListener('info', event => {
            Toast.fire({
                icon: 'info',
                title: event.detail.message != null ? event.detail.message : 'Proceso realizado.'
            });
        });
        window.addEventListener('error', event => {
            Toast.fire({
                icon: 'error',
                title: event.detail.message != null ? event.detail.message : 'Proceso no realizado.'
            });
        });
    </script>
    @if (session('login'))
        <script>
            Toast.fire({
                icon: 'success',
                title: 'Sesión iniciada'
            })
        </script>
    @endif
    @if (session('noLogin'))
        <script>
            Toast.fire({
                icon: 'error',
                title: 'Usuario o contraseña mal.'
            })
        </script>
    @endif
    <script>
        window.addEventListener('update-cart', event => {
            Toast.fire({
                icon: 'success',
                title: 'Carrito actualizado.'
            })
        });
    </script>
    {{-- <script>
        gridGallery({
            selector: "#horizontal",
            layout: "square",
            columnWidth: 300
        });
    </script> --}}
    @yield('js')
</body>

</html>


{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('layout.style')
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <script src="https://kit.fontawesome.com/38aa47f16a.js" crossorigin="anonymous"></script>
    <title>{{ $result['title'] }}</title>
    <style>
        a {
            text-decoration: none;
        }

        #sizeImage {
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div style="padding: 1% 5% 0% 5%;">
        @include('partials.nav')
    </div>
    <div class="grid grid-cols-1">
        <div style="min-height: 65vh;" class="px-4">
            @yield('content')
        </div>
    </div>
    <div class="grid grid-cols-1">
        <div style="padding: 1% 8% 0% 8%;">
            @include('partials.footer')
        </div>
    </div>
    @include('web/login')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('fontawesome\js\all.min.js') }}"></script>
    <script>
        function cargando(params) {
            Swal.fire({
                title: '<i class="fa-solid fa-rotate fa-5x fa-spin-pulse"></i>',
                html: "<h1>Cargado...</h1>",
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
            })
        }
    </script>
    <script>
        $('#exampleModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        window.beforeunload = updateUsersOnline()
        window.onload = updateUpUsersOnline()

        function updateUsersOnline() {
            var xmlhttp = new XMLHttpRequest();

            // Definir función de respuesta
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Mostrar respuesta del servidor en consola
                    console.log(this.responseText);
                }
            };

            // Abrir conexión y enviar petición al servidor
            xmlhttp.open("GET", "/updateDownUsersOnline", true);
            xmlhttp.send();
        }

        function updateUpUsersOnline() {
            const updateUsersOnline = {!! json_encode(session('updateUsersOnline')) !!}
            const isLogin = {!! json_encode(session('isLogin')) !!}
            if (!updateUsersOnline && isLogin) {
                var xmlhttp = new XMLHttpRequest();

                // Definir función de respuesta
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Mostrar respuesta del servidor en consola
                        console.log(this.responseText);
                    }
                };

                // Abrir conexión y enviar petición al servidor
                xmlhttp.open("GET", "/updateUpUsersOnline", true);
                xmlhttp.send();
                console.log("Users Online Update")
            }
        }
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

</html> --}}
