@extends('admin.layout.layout')
@section('content')
    <div class="row">

        {{-- @if (!empty($result['images'])) --}}
        @foreach ($result['images'] as $item)
            <div class="col p-2 text-center">
                <x-card-img url="{{ asset($item->image_path) }}" alt="{{ $item->image_name }}" id="{{ $item->id }}" />
            </div>
        @endforeach
        {{-- @endif --}}
    </div>
@endsection
@section('js')
@endsection
