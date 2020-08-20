@php /* @var App\Entities\Blog\Post\Post $post */ @endphp

<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th class="w-10">{{ __('misc.actions') }}</th>
        <th class="w-15">{{ __('user.post-image') }}</th>
        <th class="w-15">{{ __('backend.post-author') }}</th>
        <th>{{ __('user.post-title') }}</th>
        <th>{{ __('backend.trashed') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td class="text-center">
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary fa fa-edit"
                   title="{{ __('misc.edit') }}"></a>
                <form action="{{ route('admin.posts.delete', $post) }}" method="post" class="d-inline ml-1">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm()"
                            class="btn btn-sm btn-outline-danger fa fa-trash-alt"></button>
                </form>
            </td>
            <td class="text-center"><img src="{{ $post->imageUrl() }}" width="150"></td>
            <td>{{ $post->author->nickname }}</td>
            <td>{{ $post->title }}</td>
            <td class="text-center">
                @if($post->trashed())
                    <form action="{{ route('admin.posts.restore', $post) }}" method="post">
                        @csrf
                        @method('patch')
                        <button type="submit" onclick="return confirm()" class="btn btn-sm btn-success">{{ __('backend.restore') }}</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

