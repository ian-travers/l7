@php /* @var App\Entities\Page $rootPage */ @endphp

@foreach($rootPages as $rootPage)
    <option value="{{ $rootPage->id }}"

        @isset($page->parent_id)
            @if ($page->parent_id == $rootPage->id)
                selected="selected"
            @endif
        @endisset
    >
        {{ $rootPage->link }}
    </option>

@endforeach


