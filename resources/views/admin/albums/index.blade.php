@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-12 my-4 text-end">
            <x-btn-add url="{{ URL('/admin/albums/add') }}" />
        </div>
        <div class="col-12 col-sm-12 col-md-12">
            <div class="table-respose">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Empresa</th>
                        <th>Titulo</th>
                        <th>Estatus</th>
                        <th>Fecha</th>
                        <th># imagenes</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @if (!empty($result['albums']))
                            @foreach ($result['albums'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ $item->album_name }}</td>
                                    <td>
                                        <x-status value="{{ $item->album_status }}" />
                                    </td>
                                    <td>{{ $item->date }}</td>
                                    <td class="text-center">{{ $item->images_count }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <x-btn-edit url="{{ URL('/admin/albums/edit', base64_encode($item->id)) }}">
                                                    Editar
                                                </x-btn-edit>
                                            </div>
                                            <div class="col">
                                                <x-top-album id="{{ $item->id }}" number="{{ $item->albums_top }}" />
                                            </div>
                                        </div>
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
    <div class="modal fade" id="modal_album_top" tabindex="-1" aria-labelledby="modal_album_topLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_album_topLabel">Album Top</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="div_album_top">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn_album_top', function() {
                // cargando();
                let id = $(this).data('id');
                $('#div_album_top').empty();
                if (id > 0) {
                    $.ajax({
                        type: "get",
                        url: "<?= url('/admin/albums/top') ?>" + "/" + id,
                        dataType: "html",
                        success: function(res) {
                            console.log(res);
                            $('#div_album_top').html(res);
                            $('#modal_album_top').modal('show');
                        }
                    });
                }
            });
        });
    </script>
@endsection
