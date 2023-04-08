<div>
    @switch($value)
        @case('A')
            <span class="badge bg-success">Activo</span>
        @break

        @case('I')
            <span class="badge bg-warning text-dark">Inactivo</span>
        @break

        @default
            <span class="badge bg-danger">Eliminado</span>
    @endswitch
</div>
