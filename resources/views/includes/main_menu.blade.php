<div class="dropdown me-2">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
        {{ __('app.Menu Programm') }}
    </button>
    @if (isset(request()->menu) && request()->menu)
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
        @foreach(request()->menu as $menu_item)
                <li><a class="dropdown-item" href="{{ $menu_item['url'] }}">{{ $menu_item['title'] }}</a></li>
        @endforeach
        </ul>
    @endif
</div>
