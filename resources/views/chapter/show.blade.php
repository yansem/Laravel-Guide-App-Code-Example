<x-app-layout :title="__('Chapter') . ' - ' . $guide->title">
    <div class="content position-relative p-4">
        @include('includes.breadcrumbs')
        <div class="content__body" style="overflow-wrap: anywhere;">
            <div class="content__title d-flex w-auto">
                <div class="sidebarSubMenu__closeMob pb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#5c65e0"
                         class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <h1 class="h2">{{ $chapter->title }}</h1>
            </div>
            {!! $chapter->text_html !!}
            <div class="pagination d-flex justify-content-between pt-4">
                <div class="page-item" style="max-width: 45%; cursor: pointer;">
                    @if ($guide->chapters->sortBy('sort')->first()->id !== $chapter->id)
                        <span style="font-size: 13px; line-height: 18px;">
                            <a class="link_color text-decoration-none float-start"
                               href="{{ route('chapter.show', ['guide' => $guide->id, 'chapter' => $guide->chapters->firstWhere('sort', $chapter->sort - 1)->id]) }}"
                               tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </svg>
                                <span style="font-size: 12px">Назад</span><br>
                                <span style="font-size: 14px; margin-top: 3px; display: inline-block;">{{ $guide->chapters->firstWhere('sort', $chapter->sort - 1)->title }}</span>
                            </a>
                        </span>
                    @endif
                </div>
                <div class="page-item" style="max-width: 45%; cursor: pointer; text-align: right">
                    @if ($guide->chapters->sortBy('sort')->last()->id !== $chapter->id)
                        <span style="font-size: 13px; line-height: 18px;">
                            <a class="link_color text-decoration-none float-end"
                               href="{{ route('chapter.show', ['guide' => $guide->id, 'chapter' => $guide->chapters->firstWhere('sort', $chapter->sort + 1)->id]) }}">
                                <span style="font-size: 12px">Вперёд</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                        <br>
                                <span style="font-size: 14px; margin-top: 3px; display: inline-block;">{{ $guide->chapters->firstWhere('sort', $chapter->sort + 1)->title }}</span>
                            </a>
                        </span>
                    @endif
                </div>
            </div>
            <div class="buttonUp buttonUp__hide">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#5c65e0"
                     class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
            </div>
        </div>
    </div>
</x-app-layout>
