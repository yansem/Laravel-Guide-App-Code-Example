<x-app-layout :title="__('Guide') . ' - ' . $guide->title">
    <div class="content position-relative p-4">
        @include('includes.breadcrumbs')
        <div class="content__body" style="overflow-wrap: anywhere;">
            <div class="content__title d-flex w-auto mb-1 align-items-center">
                <div class="sidebarSubMenu__closeMob pb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#5c65e0"
                         class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <h1 class="h2 mb-0 h2MargDesktop">{{ $guide->title }}</h1>
                <div class="title__button mb-0">
                    <a href="{{ $guide->program_link }}" class="btn btn-info" title="{{ __('Link to the program') }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-box-arrow-up-right text-white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                            <path fill-rule="evenodd"
                                  d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                        </svg>
                    </a>
                    @if ($userPermission > 1)
                        <a href="{{ $guide->doc_link }}" class="btn btn-secondary" title="{{ __('Link to onlyoffice') }}" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-box-arrow-up-right text-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                                <path fill-rule="evenodd"
                                      d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('guide.edit', $guide->id) }}" class="btn btn-primary"
                           title="{{ __('Edit') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 fill="currentColor" class="bi bi-pencil-square"
                                 viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd"
                                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                            </svg>
                        </a>
                        @if (!$guide->approved)
                            <form action="{{ route('guide.approval', $guide->id) }}"
                                  method="post">
                                @csrf
                                <button type="submit" class="btn btn-success text-white"
                                        title="{{ __('Confirm') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                        @if ($guide->deleted_at === null)
                            <form action="{{ route('guide.destroy', $guide->id) }}"
                                  method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" title="{{ __('Hide') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5
     0 0 1-.708-.708L7.293 8 2.146 2.854Z"></path>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('guide.restore', $guide->id) }}"
                                  method="post">
                                @csrf
                                <button type="submit" class="btn btn-info text-white" title="{{ __('Restore') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-arrow-clockwise"
                                         viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                        <path
                                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
                <div>
                    <ul>
                        @foreach($guide->chapters->sortBy('sort') as $chapter)
                        <li class="m-2">
                            <a class="link_color" href="{{ route('chapter.show', ['guide' => $guide->id, 'chapter' =>
                                            $chapter->id]) }}">{{ $chapter->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
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
