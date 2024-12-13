@unless ($breadcrumbs->isEmpty())
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item">
                        @if ($loop->first)
                            <i class="mb-1" data-feather="home"></i>
                        @endif
                        <a href="{{ $breadcrumb->url }}">
                            {{ __($breadcrumb->title) }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        @if ($loop->first)
                            <i class="mb-1" data-feather="home"></i>
                        @endif
                        {{ __($breadcrumb->title) }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endunless
