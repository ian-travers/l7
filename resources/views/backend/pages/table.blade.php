@php /* @var \App\Entities\Page\Page $page */ @endphp

<table class="table table-sm table-bordered mb-0">
    <thead>
    <tr>
        <th class="text-center stick-top w-20">{{ __('misc.actions') }}</th>
        <th class="stick-top">{{ __('backend.title_en') }}</th>
        <th class="stick-top">{{ __('backend.title_ru') }}</th>
        <th class="stick-top">{{ __('backend.link_en') }}</th>
        <th class="stick-top">{{ __('backend.link_ru') }}</th>
        <th class="stick-top">{{ __('backend.path') }}</th>
        <th class="text-center stick-top w-10">{{ __('backend.parent_id') }}</th>
        <th class="text-center stick-top w-10">{{ __('backend.ID') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($pages as $page)
        <tr>
            <td class="text-center">
                <a href="{{ route('admin.pages.show', $page) }}" class="btn btn-primary btn-sm fa fa-eye" title="{{ __('misc.show') }}"></a>
                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary btn-sm fa fa-edit" title="{{ __('misc.edit') }}"></a>
                <form class="d-inline" action="{{ route('admin.pages.delete', $page) }}" method="post">

                    @method('delete')
                    @csrf
                    <button type="submit" onclick="return confirm('{{ __('misc.confirm-delete') }}')"
                            class="btn btn-danger btn-sm fa fa-trash" title={{ __('misc.delete') }}></button>
                </form>
            </td>
            <td>{{ $page->title_en }}</td>
            <td>{{ $page->title_ru }}</td>
            <td>{{ $page->link_en }}</td>
            <td>{{ $page->link_ru }}</td>
            <td>{{ $page->path }}</td>
            <td class="text-center">{{ $page->parent_id }}</td>
            <td class="text-center">{{ $page->id }}</td>
        </tr>

    @endforeach
    </tbody>
</table>


