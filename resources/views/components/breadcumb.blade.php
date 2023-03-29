<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            @if (!empty($data))
                @foreach ($data as $key=> $item)
                    <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{$item['title']}}</a></li>
                @endforeach
            @endif
        </ol>
    </nav>
</div>
