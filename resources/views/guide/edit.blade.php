<x-app-layout :title="__('Editing guide')">
    <div class="content position-relative p-4">
        @include('includes.breadcrumbs')
        <div class="content__body">
            <div class="content__title d-flex w-auto mb-1">
                <div class="sidebarSubMenu__closeMob">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#5c65e0"
                         class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <h1 class="h2">{{ __('Editing guide') }}</h1>
            </div>
            <form action="{{ route('guide.update', $guide->id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Title') }}<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           name="title" id="title" value="{{ old('title', $guide->title) }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">{{ __('Icon') }} (<a href="https://icons.getbootstrap.com/"
                                                                              target="_blank"
                                                                              rel="noopener noreferrer">{{ __('available icons') }}</a>)</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror"
                           name="icon" id="icon" value="{{ old('icon', $guide->icon) }}">
                    <div id="iconHelp" class="form-text">Пример иконки: {{ '<i class="' }}<span
                            class="text-danger text-decoration-underline">bi bi-tag-fill</span>{{ '"></i>' }}</div>
                    @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="program-link" class="form-label">{{ __('Link to the program') }}<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('program_link') is-invalid @enderror"
                           name="program_link" id="program-link"
                           value="{{ old('program_link', $guide->program_link) }}">
                    @error('program_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="doc-link" class="form-label">{{ __('Link to onlyoffice') }}<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('doc_link') is-invalid @enderror"
                           name="doc_link" id="doc-link" value="{{ old('doc_link', $guide->doc_link) }}">
                    @error('doc_link')
                    <div class="invalid-feedback">{!! $message !!}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">{{ __('File') }}<span
                            class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror"
                           name="file"
                           id="file">
                    <div id="fileHelp" class="form-text">Файл формата HTML, сохраненный из <a
                            href="http://onlyoffice.orlan.in/" target="_blank">onlyoffice.orlan.in</a></div>
                    @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if ($guide->files->isNotEmpty())
                    <div class="mb-3">
                        <a href="#" id="files" onclick="return false">Показать ранее загруженные файлы</a>
                        <ul class="d-none" id="filesList">
                            @foreach($guide->files as $files)
                                <li><a href="{{ $files->path }}" download>{{ $files->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="sort" class="form-label">{{ __('Sorting') }}</label>
                    <input type="number" class="form-control @error('sort') is-invalid @enderror"
                           name="sort" id="sort" value="{{ old('sort', $guide->sort) }}">
                    @error('sort')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="hidden" name="public" value="0">
                    <input type="checkbox" class="form-check-input @error('public') is-invalid @enderror"
                           name="public" id="public" value="1" @checked($guide->public)>
                    <label for="public" class="form-label">{{ __('Public') }}</label>
                    @error('public')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
            <div class="buttonUp buttonUp__hide">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#5c65e0"
                     class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            let files = document.getElementById('files')
            if (files !== null) {
                files.addEventListener('click', () => {
                    console.log(1);
                    document.getElementById('filesList').classList.toggle('d-none')
                })
            }
        </script>
    @endpush
</x-app-layout>
