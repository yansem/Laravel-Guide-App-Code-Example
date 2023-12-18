@if(Breadcrumbs::has())
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
    @foreach (Breadcrumbs::current() as $crumbs)
        @if ($crumbs->url() && !$loop->last)
            <li class="breadcrumb-item">
                <a href="{{ $crumbs->url() }}">
                    {{ $crumbs->title() }}
                </a>
            </li>
        @else
            <li class="breadcrumb-item active">
                {{ $crumbs->title() }}
            </li>
        @endif
    @endforeach
        </ol>
    </nav>
@endif
