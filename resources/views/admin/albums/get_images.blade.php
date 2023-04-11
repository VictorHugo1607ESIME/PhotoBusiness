<div class="row">
    @if (!empty($images))
        @foreach ($images as $item)
            <div class="col p-2" >
                <x-card-img url="{{ asset($item->image_path) }}" alt="{{ $item->image_name }}" id="{{ $item->id }}" />
            </div>
        @endforeach
    @endif
</div>
