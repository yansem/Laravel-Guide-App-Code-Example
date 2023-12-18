<x-app-layout :title="__('Welcome')">
    <div class="content position-relative p-4">
        <div class="content__body">
            <div class="content__title d-flex w-auto mb-1">
                <h1 class="h2">{{ __('Welcome') }}</h1>
            </div>
            @if ($userPermission > 1)
                <a class="me-2 d-flex cursor-pointer align-items-center link" href="{{ route('guide.create') }}">{{ __('Add guide') }}</a>
            @endif
        </div>
    </div>
</x-app-layout>
