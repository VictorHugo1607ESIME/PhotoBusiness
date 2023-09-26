<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="{{ asset('fontawesome\js\all.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/js/iziModal.min.js"
    integrity="sha512-lR/2z/m/AunQdfBTSR8gp9bwkrjwMq1cP0BYRIZu8zd4ycLcpRYJopB+WsBGPDjlkJUwC6VHCmuAXwwPHlacww=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    function cargando() {
        Swal.fire({
            title: '<i class="fa-solid fa-spinner fa-spin fa-3x"></i>',
            html: 'Cargando...',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            showConfirmButton: false
        });
    }

    function close() {
        swal.close();
    }
</script>
<script>
    // cargando();
    window.addEventListener('close', event => {
        close();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('component.initialized', (component) => {
            console.log('1');
        });
        Livewire.hook('element.initialized', (el, component) => {
            console.log('2');
            close();
        });
        Livewire.hook('element.updating', (fromEl, toEl, component) => {
            console.log('3');
        });
        Livewire.hook('element.updated', (el, component) => {
            console.log('4');
        });
        Livewire.hook('element.removed', (el, component) => {
            console.log('5');
        });
        Livewire.hook('message.sent', (message, component) => {
            cargando();
            console.log('6');
        });
        Livewire.hook('message.failed', (message, component) => {
            console.log('7');
        });
        Livewire.hook('message.received', (message, component) => {
            console.log('8');
        });
        Livewire.hook('message.processed', (message, component) => {
            close();
            console.log('9');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "ordering": false
        });
        $('.paginate_button').addClass(
            'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700'
            );
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/exifreader@4.13.0/dist/exif-reader.min.js"></script>


