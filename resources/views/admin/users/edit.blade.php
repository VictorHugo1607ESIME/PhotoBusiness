@extends('admin.layout.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 text-center">
            <h2>Editar el usuario</h2>
        </div>
        <div class="col-12 col-sm-12 col-md-6">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">Datos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Contaseña</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="config-tab" data-bs-toggle="tab" data-bs-target="#config" type="button"
                        role="tab" aria-controls="config" aria-selected="false">Configuración</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.users.form_datos')
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @include('admin.users.form_pass')
                </div>
                <div class="tab-pane fade" id="config" role="tabpanel" aria-labelledby="config-tab">
                    @include('admin.users.form_config')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.viewPass').click(function(e) {
                e.preventDefault();
                console.log();
                $(this).empty();
                if ($("#password").attr("type") == 'text') {
                    $('.pass').attr('type', 'password');
                    $(this).html('<i class="fa-regular fa-eye"></i>');
                } else {
                    $('.pass').attr('type', 'text');
                    $(this).html('<i class="fa-solid fa-eye-slash"></i>');
                }
            });
        });
    </script>
@endsection
