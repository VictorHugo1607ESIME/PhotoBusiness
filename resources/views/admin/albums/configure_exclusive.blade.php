@extends('admin.layout.layout')
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-12 col-sm-12 col-md-6">
            <h2 class="text-center">Exclusiva de album {{ $result['album']->album_name }}</h2>
            <form action="{{ URL('/admin/albums/update/exclusive') }}" method="POST">
                @csrf
                <div class=" mt-4">
                    <input type="hidden" name="id_album" value="{{ $result['album']->id }}">
                    <label>Selecciona los usuarios:</label>
                    <select id="multiple-checkboxes" multiple="multiple" class="form-control" name="ids[]">
                        @if (!empty($result['users']))
                            @foreach ($result['users'] as $item)
                                <option value="{{ $item->id }}">{{ $item->user_name }} -{{ $item->id }} </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-primary" type="submit">Guarda</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="table-respose">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @if (!empty($result['users_exclusive']))
                            @foreach ($result['users_exclusive'] as $item)
                                <tr>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <button data-id="{{ $item->id }}" class="btn btn-danger delete_exclusive">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

    <script>
        $(document).ready(function() {
            $('#multiple-checkboxes').multiselect({
                includeSelectAllOption: true,
            });
            $(document).on('click', '.delete_exclusive', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Eliminar',
                    text: "¿Estas seguro de eliminar el registro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si,eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        delete_album(id);
                    }
                });
            });

            function delete_album(id) {
                $.ajax({
                    type: "get",
                    url: "<?= URL('/admin/albums/exclusives/delete') ?>" + "/" + id,
                    dataType: "json",
                    success: function(res) {
                        if (res.success) {
                            Swal.fire(
                                'Realizado',
                                'Dato borado con éxito',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error',
                                'Dato no borado con éxito',
                                'error'
                            )
                        }
                    }
                });
            }
        });
    </script>
@endsection
