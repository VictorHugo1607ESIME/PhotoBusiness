<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link rel="shortcut icon" href="{{ asset('/images/Logo-800.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- .color1 { #e6b39a };
        .color2 { #e6cba5 };
        .color3 { #ede3b4 };
        .color4 { #8b9e9b };
        .color5 { #6d7578 }; --}}
    <style>
        .contenedor {
            width: 600px;
        }

        body {
            background-color: #ede3b4;
        }

        @media only screen and (max-width: 550px) {
            body {
                background-color: #8b9e9b;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center" style="padding-top: 2em">
            <div class="col-12 col-sm-12 col-md-6 rounded-4 contenedor"
                style="background:  #8b9e9b; margin-bottom: 4em">
                <div class="row justify-content-center">
                    <div class="col-12 text-center" style="height: 200px">
                        {{-- logo --}}
                    </div>
                    <div class="col-10 col-sm-10 col-md-8 text-center">
                        <p style="font-size: 25px;color:white"> <strong>Bienvenido</strong> al administrador de tu
                            plataforma
                        </p>
                        <p style="font-size:20px;color:white">Ingresa tus datos para iniciar sesión</p>
                    </div>
                    <div class="col-10 col-sm-10 col-md-6">
                        <form method="POST">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-12 my-2">
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="Correo electrónico">
                                </div>
                                <div class="col-12 my-2">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Contraseña" aria-label="Recipient's username"
                                            aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary rounded-end eyes" type="button"
                                            id="button-addon2" onclick="mostrarContrasena()"><i
                                                class="fa-solid fa-eye"></i></button>
                                    </div>

                                </div>
                                <div class="col-6 mb-4">
                                    <div class="d-grid gap-2 my-2">
                                        <button type="submit" class="btn" style="background: #6d7578" type="button">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        function mostrarContrasena() {
            var tipo = document.getElementById("password");
            $('.eyes').empty();
            if (tipo.type == "password") {
                tipo.type = "text";
                $('.eyes').html('<i class="fa-solid fa-eye-slash"></i>');
            } else {
                tipo.type = "password";
                $('.eyes').html('<i class="fa-solid fa-eye"></i>');
            }
        }
    </script>
</body>

</html>
