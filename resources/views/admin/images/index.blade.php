@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-12 my-4">
            <a class="btn btn-success" href="{{ url('admin/albums/syncFTP') }}" target="_blank">Sincronizar FTP</a>
        </div>
    </div>
    <div class="row justify-content-start" id="div_image">

        {{-- @if (!empty($result['images'])) --}}
        @foreach ($result['images'] as $item)
            <div class="col p-2 text-center">
                <x-card-img url="{{ asset($item->optimice_path) }}" alt="{{ $item->image_name }}" id="{{ $item->id }}"  />
            </div>
        @endforeach
        {{-- @endif --}}
    </div>
@endsection
@section('js')
@endsection
