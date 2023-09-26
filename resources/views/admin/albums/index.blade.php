@extends('admin.layout.app2')
@section('css')
    <style>
        a.paginate_button {
            background-color: white;
            padding: 10px;
            text-align: center;
            display: inline-block;
            border: gray 1px solid;
        }

        a.paginate_button.current {
            color: #3498DB;
        }

        div#myTable_length {
            width: 400px !important;
        }

        div#myTable_filter {
            width: 400px !important;
            display: inline;
        }
    </style>
@endsection
@section('content')
    <div class="grid grid-cols-10 gap-4">
        <div class="col-span-2 col-start-9">
            <a href="{{ URL('/admin/albums/add') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4
        focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700
        dark:focus:ring-blue-800">Agregar
                album</a>
        </div>
    </div>
    <div>
        @livewire('table-albums')
    </div>
@endsection
@section('js')
@endsection
