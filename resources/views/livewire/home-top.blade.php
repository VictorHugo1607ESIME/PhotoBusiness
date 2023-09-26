{{-- <div class="mb-8">
    <div class="grid grid-cols-8 gap-2" style="height: 60vh">
        @if ($dataArray[0]['height'] <= $dataArray[1]['height'])
            <div class="col-span-5"
                style="width: 100%; max-height: 60vh;display: flex;
            justify-content: flex-end;">
                <a href="{{ $dataArray[0]['ruta'] }}">
                    <img src="{{ $dataArray[0]['url'] }}" alt="" style="height: 100%;object-fit: scale-down;">
                </a>
            </div>
            <div class="col-span-3"
                style="width: 100%;max-height: 60vh;display: flex;
            justify-content: flex-start;">
                <a href="{{ $dataArray[1]['ruta'] }}">
                    <img src="{{ $dataArray[1]['url'] }}" alt="" style="height: 100%;object-fit: scale-down;">
                </a>
            </div>
        @else
            <div class="col-span-3"
                style="width: 100%;max-height: 60vh;display: flex;
            justify-content: flex-end;">
                <a href="{{ $dataArray[0]['ruta'] }}">
                    <img src="{{ $dataArray[0]['url'] }}" alt="" style="height: 100%;object-fit: scale-down;">
                </a>
            </div>
            <div class="col-span-5"
                style="width: 100%;max-height: 60vh;display: flex;
            justify-content: flex-start;">
                <a href="{{ $dataArray[1]['ruta'] }}">
                    <img src="{{ $dataArray[1]['url'] }}" alt="" style="height:100% ;object-fit: scale-down;">
                </a>
            </div>
        @endif
    </div>

</div> --}}

<div class="container mx-auto mt-4">
    @if ($dataArray[0]['height'])
        <div class="grid grid-cols-1" style="overflow: hidden">
            @if (isset($dataArray[0]))
                <div style="width: 100%;height:750px" class="text-center justify-center" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="{{ $dataArray[0]['album'] }}">
                    <a href="{{ $dataArray[0]['ruta'] }}" class="flex justify-start">
                        <img src="{{ $dataArray[0]['url'] }}" alt=""
                            style="object-fit:scale-down;height: 100%;">
                    </a>

                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 bg-gray-600 text-center">
            <p class="text-white font-bold py-2 text-center">{{ $dataArray[0]['album'] }}</p>
        </div>
    @endif

</div>
