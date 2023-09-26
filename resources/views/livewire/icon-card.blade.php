<div>
    @if (session('isLogin') == true)
        <a href="{{ url('/shoppingcart') }}" class="font-bold text-black-600  hover:underline"><i
                class="fa-solid fa-cart-shopping"></i><span class="text-red-700">( <span
                    class="text-black">{{ $contador }}</span>)</span></a>
    @else
        <a href="{{ url('/shoppingcart') }}" class="font-bold text-black-600  hover:underline"><i
                class="fa-solid fa-cart-shopping"></i>(0)</a>
    @endif
    <div class="hidden">
        <button type="button" id="update_cart" class="" wire:click='update_cart'>actualizar</button>
    </div>

</div>
