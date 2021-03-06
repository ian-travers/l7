@php /* @var App\Entities\News\News $new */ @endphp

<table class="table table-sm table-bordered mb-0">
    <thead>
    <tr>
        <th class="w-10">{{ __('misc.actions') }}</th>
        <th>{{ __('backend.title_en') }}</th>
        <th>{{ __('backend.title_ru') }}</th>
        <th>{{ __('backend.body_en') }}</th>
        <th>{{ __('backend.body_ru') }}</th>
        <th class="w-10">{{ __('backend.trashed') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($news as $new)
        <tr>
            <td class="text-center">
                <a href="{{ route('admin.news.edit', ['news' => $new, 'page' => $news->currentPage()]) }}"
                   class="btn btn-sm btn-outline-primary fa fa-edit"
                   title="{{ __('misc.edit') }}"></a>
                @if($new->trashed())
                    <button type="button" class="btn btn-sm btn-outline-warning fa fa-trash ml-1 disabled"></button>
                @else
                    <form action="{{ route('admin.news.delete', $new) }}" method="post" class="d-inline ml-1">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm()"
                                class="btn btn-sm btn-outline-warning fa fa-trash"
                                title="{{ __('backend.move-to-trash') }}"></button>
                    </form>
                @endif
            </td>
            <td>{{ $new->title_en }}</td>
            <td>{{ $new->title_ru }}</td>
            <td>{{ $new->body_en }}</td>
            <td>{{ $new->body_ru }}</td>
            <td class="text-center">
                @if($new->trashed())
                    <form action="{{ route('admin.news.restore', $new) }}" method="post" class="d-inline ml-1">
                        @csrf
                        @method('patch')
                        <button type="submit" onclick="return confirm()"
                                class="btn btn-sm btn-success fa fa-trash-restore-alt"
                                title="{{ __('backend.restore') }}"></button>
                    </form>
                    <form action="{{ route('admin.news.force-delete', $new) }}" method="post" class="d-inline ml-1">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm()"
                                class="btn btn-sm btn-outline-danger fa fa-trash-alt"
                                title="{{ __('backend.remove-from-trash') }}"></button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
