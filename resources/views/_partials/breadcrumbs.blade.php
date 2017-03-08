@if ($breadcrumbs)
    <div class="span9 breadcrumbs">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->first)
                <span><a href="{{ $breadcrumb->url }}"><span>{{ $breadcrumb->title }}</span></a></span>
            @elseif (!$breadcrumb->last)
                ← <span><a href="{{ $breadcrumb->url }}"><span>{{ $breadcrumb->title }}</span></a></span>
            @else
                ← {{ $breadcrumb->title }}
            @endif
        @endforeach
    </div>
@endif

