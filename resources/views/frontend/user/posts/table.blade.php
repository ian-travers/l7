@php /* @var App\Entities\Blog\Post\Post $post */ @endphp

<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th class="w-10">{{ __('misc.actions') }}</th>
        <th class="w-15">{{ __('user.post-image') }}</th>
        <th>{{ __('user.post-title') }}</th>
        <th>{{ __('user.post-excerpt') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td class="text-center">
                <a href="{{ route('user.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary fa fa-edit"
                   title="{{ __('misc.edit') }}"></a>
                <form action="{{ route('user.posts.delete', $post) }}" method="post" class="d-inline ml-1">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm()"
                            class="btn btn-sm btn-outline-danger fa fa-trash-alt"></button>
                </form>
            </td>
            <td class="text-center"><img src="{{ $post->imageUrl() }}" width="150"></td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->excerpt }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
