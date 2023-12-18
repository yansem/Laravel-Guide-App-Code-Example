<div class="sidebarSubMenu open shadow-sm position-fixed bottom-0 top-0 h-100">

    <ul class="sidebarSubMenu__contLinks h-100" style="overflow-x: hidden;">
{{--        <div class="sidebarSubMenu__sideBtn">--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">--}}
{{--                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>--}}
{{--            </svg>--}}
{{--        </div>--}}
        @foreach($guides as $guide)
            @if ($userPermission > 1 || ($userPermission === '1' && $guide->public && $guide->approved))
                @php
                    $showMenu = (Arr::get(Route::current()->originalParameters(), 'guide')) == $guide->id ? 'showMenu' :
                     '';
                @endphp
                <li class="{{ $showMenu ?: '' }}">
                    <div
                        class="sidebarSubMenu__navLinks d-flex justify-content-between my-1 {{ $showMenu ?: '' }}">
                        <a style="margin-left: 30px" href="{{ route('guide.show', $guide->id) }}">

                            <div>
                                @if ($userPermission > 1)
                                    <span class="guide__status" style="color: rgba(45,45,44,0.44);">
                                        @if ($guide->deleted_at !== null)
                                            [{{ __('hidden') }}]
                                        @elseif (!$guide->approved)
                                            [{{ __('awaiting confirmation') }}]
                                        @elseif (!$guide->public)
                                            [{{ __('private') }}]
                                        @endif
                                    </span>
                                @endif
                                <p class="navLinks__linkName {{ $showMenu ? 'active' : '' }}">
                                    {{ $guide->title }}
                                </p>
                            </div>
                        </a>
                        <span class='navLinks__arrow'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                           fill="currentColor" class="bi bi-chevron-down"
                                                           viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg></span>
                    </div>
                    <ul class="sub-menu list-group w-75">
                        @foreach($guide->chapters->sortBy('sort') as $chapter)
                            @php
                                $active = (Arr::get(Route::current()->originalParameters(), 'chapter')) == $chapter->id ? 'list-group-item active' : '';
                            @endphp
                            <li><a class="sub-menu__item {{ $active ?: '' }}"
                                   href="{{ route('chapter.show', ['guide' => $guide->id, 'chapter' => $chapter->id]) }}">{{ $chapter->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</div>
