@extends('admin.layout.app2')
@section('content')
    <div class="grid grid-cols-6 mb-4 gap-4 ">
        <div class="col-span-2 col-start-3 text-center">
            <h2>Agregar nuevo usuario</h2>
        </div>
    </div>
    <div class="grid grid-cols-6 mb-4 gap-4 ">
        <div class="col-span-2 col-start-3">
            @livewire('user-add')
        </div>
    </div>
@endsection
