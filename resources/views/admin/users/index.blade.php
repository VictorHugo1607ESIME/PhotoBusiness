@extends('admin.layout.app2')
@section('content')
    <div class="grid grid-cols-10 gap-4">
        <div class="col-span-2 col-start-9">
            <a href="{{ URL('/admin/users/add') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4
            focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">Agregar
                usuario</a>
        </div>
    </div>
    <div class="grid grid-cols-1 mt-4 gap-4">
        @livewire('users-table')
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deletedUser', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: '¿Estas seguro de querer eliminar?',
                    showCancelButton: true,
                    confirmButtonColor: '#B03A2E',
                    confirmButtonText: 'Si, Eliminar',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Eliminado', '', 'success')
                    }
                })
            });
        });
    </script>
@endsection
