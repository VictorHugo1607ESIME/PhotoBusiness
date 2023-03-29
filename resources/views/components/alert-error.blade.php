<div>
    <div class="alert alert-danger" role="alert" id="alert-error">
        <div class="row">
            <div class="col-11">
                {{ !empty($message) ? $messsage : 'Proceso no realizado verifica la información' }}
            </div>
            <div class="col-1">
                <button class="btn btn-danger eliminarAlert" data-id="alert-error">X</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            Toast.fire({
                icon: 'error',
                title: 'Error al realizar el proceso.'
            });
        });
    </script>
@endpush
