<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ $result['title'] }}</title>
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
<body style="padding: 1% 8% 0% 8%;">
    @include('partials.nav')
    <div style="min-height: 65vh">
       @yield('content')
    </div>
    @include('partials.footer')
    @include('web/login')
    <script>
        window.beforeunload = updateUsersOnline()
        window.onload = updateUpUsersOnline()

        function updateUsersOnline(){
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

        function updateUpUsersOnline(){
            const updateUsersOnline = {!! json_encode(session('updateUsersOnline')); !!}
            const isLogin = {!! json_encode(session('isLogin')); !!}
            if(!updateUsersOnline && isLogin){
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</html>
