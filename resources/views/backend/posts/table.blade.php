@php /* @var App\Entities\Blog\Post\Post $post */ @endphp

<table class="table table-sm table-bordered mb-0">
    <thead>
    <tr>
        <th class="w-10">{{ __('misc.actions') }}</th>
        <th class="w-15">{{ __('user.post-image') }}</th>
        <th class="w-15">{{ __('backend.post-author') }}</th>
        <th>{{ __('user.post-title') }}</th>
        <th class="w-10">{{ __('user.publication') }}</th>
        <th>{{ __('backend.trashed') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td class="text-center">
                <a href="{{ route('admin.posts.edit', ['id' => $post->id, 'page' => $posts->currentPage()]) }}"
                   class="btn btn-sm btn-outline-primary fa fa-edit"
                   title="{{ __('misc.edit') }}"></a>
                <form action="{{ route('admin.posts.delete', $post) }}" method="post" class="d-inline ml-1">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm()"
                            class="btn btn-sm btn-outline-danger fa fa-trash-alt"
                            title="{{ __('misc.delete') }}"></button>
                </form>
            </td>
            <td class="text-center"><img src="{{ $post->imageUrl() }}" width="150" alt=""></td>
            <td>{{ $post->author->nickname }}</td>
            <td>{{ $post->title }}</td>
            <td class="text-center">
                @if(!$post->trashed())
                    @if($post->isPublished())
                        <form action="{{route('admin.posts.unpublish', $post)}}" method="post">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">{{ __('user.unpublish') }}</button>
                        </form>
                    @else
                        <form action="{{route('admin.posts.publish', $post)}}" method="post">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('user.publish') }}</button>
                        </form>
                    @endif
                @endif
            </td>
            <td class="text-center">
                @if($post->trashed())
                    <form action="{{ route('admin.posts.restore', $post) }}" method="post">
                        @csrf
                        @method('patch')
                        <button type="submit" onclick="return confirm()"
                                class="btn btn-sm btn-success fa fa-trash-restore-alt"
                                title="{{ __('backend.restore') }}"></button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

