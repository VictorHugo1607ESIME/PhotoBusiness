<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}


    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script src="{{ asset('fontawesome\js\all.min.js') }}"></script>
    @include('admin.sections.css')
    @yield('css')
    <title>@yield('title')</title>
</head>

<body>
    <div class="container-fluid">
        @include('admin.sections.nav')
    </div>
    <div class="modal fade" id="mdalImagen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="mdalImagenLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mdalImagenLabel">Información de imagen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="div_info_imagen">
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(document).on('click', '.eliminarAlert', function() {
                let id = $(this).data('id');
                console.log(id);
                $('#' + id).hide();
            });
        });
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
        });
        $(document).on('click', '.deletedImagen', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: '¿Estas seguro de querer eliminar?',
                showCancelButton: true,
                confirmButtonColor: '#B03A2E',
                confirmButtonText: 'Si, Eliminar',

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    deleteImagen(id);
                }
            })
        });
        $(document).on('click', '.btn_modal_imagen', function() {
            let id = $(this).data('id');
            $('#div_info_imagen').empty();
            if (id > 0) {
                $.ajax({
                    type: "get",
                    url: "<?= URL('/admin/images/info') ?>" + "/" + id,
                    dataType: "html",
                    success: function(res) {
                        console.log(res);
                        $('#div_info_imagen').html(res);
                        $('#mdalImagen').modal('show');
                    }
                });
            }
        });

        function deleteImagen(id) {
            cargando();
            $.ajax({
                type: "get",
                url: "<?= url('/admin/images/deleted') ?>" + "/" + id,
                dataType: "json",
                success: function(res) {
                    console.log(res);
                    if (res.success) {
                        if ($('#div_image')) {
                            Swal.fire(
                                'Realizado',
                                'Proceso completado',
                                'success'
                            )
                            $('#div_image').empty();
                            $('#div_image').html(res.html);
                        } else {
                            Swal.fire(
                                'Realizado',
                                'Proceso completado',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    } else {
                        Swal.fire(
                            'Error',
                            'Proceso no realizado',
                            'error'
                        )
                    }
                }
            });
        }

        function cargando() {
            Swal.fire({
                title: 'هل تريد الاستمرار؟',
                icon: 'question',
                iconHtml: '؟',
                showCancelButton: false,
                showCloseButton: false
            })
        }
    </script>
    @yield('js')
    @stack('scripts')
</body>

</html>
