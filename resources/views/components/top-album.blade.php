<div>
    @if ($number == null || $number == 0)
        <button type="button" data-id="{{ $id }}" class="btn btn-outline-dark btn_album_top"><i
                class="fa-solid fa-star"></i></button>
    @else
        <button type="button" data-id="{{ $id }}" class="btn btn-dark btn_album_top"><i
                class="fa-solid fa-star"></i></button>
    @endif
</div>
