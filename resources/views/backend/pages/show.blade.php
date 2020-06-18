@php /* @var \App\Entities\Page\Page $page */ @endphp

<x-backend-layout :title="__('backend.show-page')">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="align-items-center">
                    <span class="h3">{{ __('backend.show-page') }}</span>
                    <a href="{{ route('admin.pages.edit', $page) }}"
                       class="btn btn-sm btn-primary mt-n2">{{ __('misc.edit') }}</a>
                    <form class="d-inline" action="{{ route('admin.pages.delete', $page) }}"
                          method="post">

                        @method('delete')
                        @csrf
                        <button type="submit" onclick="return confirm('{{ __('misc.confirm-delete') }}')"
                                class="btn btn-danger btn-sm mt-n2">{{ __('misc.delete') }}</button>
                    </form>
                </div>
                <div>
                    <a href="{{ route('admin.pages') }}"
                       class="btn btn-sm btn-primary">{{ __('backend.pages') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <tr>
                    <th>{{ __('backend.title_en') }}</th>
                    <td>{{ $page->title_en }}</td>
                </tr>
                <tr>
                    <th>{{ __('backend.title_ru') }}</th>
                    <td>{{ $page->title_ru }}</td>
                </tr>
                <tr>
                    <th>{{ __('backend.link_en') }}</th>
                    <td>{{ $page->link_en }}</td>
                </tr>
                <tr>
                    <th>{{ __('backend.link_ru') }}</th>
                    <td>{{ $page->link_ru }}</td>
                </tr>
                <tr>
                    <th>{{ __('backend.path') }}</th>
                    <td>{{ $page->path }}</td>
                </tr>
                <tr>
                    <th>{{ __('backend.content_en') }}</th>
                    <td>{{ $page->content_en }}</td>
                </tr>
                <tr>
                    <th>{{ __('backend.content_ru') }}</th>
                    <td>{{ $page->content_ru }}</td>
                </tr>
            </table>
        </div>
    </div>
</x-backend-layout>





