@extends('admin.layout.layout')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-12 col-sm-12 col-md-6">
            <h2 class="text-center">Creación de nuevo album</h2>
            <form action="{{ URL('/admin/albums/insert') }}" method="POST">
                @csrf
                <input type="hidden" name="company_id" value="{{ session('id_company') }}">
                <div class="mb-3">
                    <label for="album_name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="album_name" name="name">
                </div>
                <div class="mb-3">
                    <label for="album_date" class="form-label">Fecha de publicacion</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="mb-3">
                    <label for="exclusive" class="form-label">Album exclusivo</label>
                    <select class="form-select" aria-label="" name="exclusive" id="exclusive">
                        <option value="false">No</option>
                        <option value="true">Si</option>
                    </select>
                </div>
                <div class="mb-3 text-center">
                    <x-btn-form></x-btn-form>
                </div>
            </form>
        </div>
    </div>
@endsection
