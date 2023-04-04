<div>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"
                    style="color:#7F8C8D; text-decoration: none">Dashboard</a></li>
            @if (!empty($data))
                @foreach ($data as $key => $item)
                    <li class="breadcrumb-item"><a href="{{ $item['url'] }}"
                            style="color:#7F8C8D; text-decoration: none">{{ $item['title'] }}</a></li>
                @endforeach
            @endif
        </ol>
    </nav>
</div>
