@extends('admin.layout.layout')
@section('css')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .select-none{
        color: red !important;
    }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 my-4">
            {{-- <a class="btn btn-success" href="{{ url('admin/albums/syncFTP') }}" target="_blank">Sincronizar FTP</a> --}}
            <button type="button" id="sync_ftp" class="btn btn-success" style="color: black">Sincronizar FTP</button>
        </div>
    </div>
    <div class="row justify-content-start" id="div_image">

        @livewire('images-table')
        {{-- @if (!empty($result['images'])) --}}
        {{-- @foreach ($result['images'] as $item)
            <div class="col p-2 text-center">
                <x-card-img url="{{ asset($item->optimice_path) }}" alt="{{ $item->image_name }}" id="{{ $item->id }}" />
            </div>
        @endforeach --}}
        {{-- @endif --}}
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#sync_ftp', function() {
                sync();
            });

            function sync() {
                cargando();
                $.ajax({
                    type: "get",
                    url: "<?= URL('/sync_manual') ?>",
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.code == 200) {
                            loop();
                        } else {
                            Swal.fire(
                                'Termino',
                                'Proceso terminado',
                                'info'
                            )
                        }
                    }
                });
            }

            function loop() {
                let timerInterval
                Swal.fire({
                    title: 'Continuamos',
                    html: 'Continuamos procesando espera <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        sync();
                    }
                })
            }
        });
    </script>
@endsection
