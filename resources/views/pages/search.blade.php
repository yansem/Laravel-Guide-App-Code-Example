<x-app-layout :title="__('Search')">
    <div class="content position-relative p-4">
        @include('includes.breadcrumbs')
        <div class="content__body">
            <div class="content__title d-flex w-auto mb-1">
                <div class="sidebarSubMenu__closeMob">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#5c65e0"
                         class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <h1 class="h2">{{ __('Search result for the query ":query"', ['query' => $q]) }}</h1>
            </div>
            @if ($chapters->total() > 0)
                <ul class="content__search">
                    @foreach($results as $index => $result)
                        <li class="my-4">
                            <div class="h3" style="line-height: 20px;">
                                <a class="link_color" href=" {{ route('guide.show', ['guide' => $result['guideId']]) }}">{{ $result['guideTitle'] }}</a>
                            </div>
                            <a class="h4 link_color" href="{{ route('chapter.show', ['guide' => $result['guideId'], 'chapter' => $index]) }}">{!! $result['chapterTitle'] !!}</a>
                            <p class="my-1" style="line-height: 18px;">{!! $result['chapterText'] !!}</p>
                        </li>@endforeach
                </ul>
            @else
                <p>{{ __('Nothing was found on the request...') }}</p>
            @endif
            {{ $chapters->links() }}
            <div class="buttonUp buttonUp__hide">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#5c65e0"
                     class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
            </div>
        </div>
    </div>
</x-app-layout>
