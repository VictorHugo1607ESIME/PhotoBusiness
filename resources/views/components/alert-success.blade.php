<div>
    <div class="alert alert-success" role="alert" id="alert-success">
        <div class="row">
            <div class="col-11">
                {{ !empty($message) ? $messsage : 'Proceso realizado con éxito.' }}
            </div>
            <div class="col-1">
                <button class="btn btn-danger eliminarAlert" data-id="alert-success">X</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            Toast.fire({
                icon: 'success',
                title: 'Proceso realizado.'
            });
        });
    </script>
@endpush
