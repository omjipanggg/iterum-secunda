<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a class="breadcrumb-link" href="{{ route('dashboard.index') }}">
            <i class="bi bi-house"></i>
        </a>
    </li>
    <li class="breadcrumb-item" aria-current="page">@yield('title')</li>
  </ol>
</nav>

{{--
@unless($breadcrumbs->isEmpty())
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-3">
        @foreach($breadcrumbs as $breadcrumb)
            @if(!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}" class="breadcrumb-link">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
</nav>
@endunless
--}}