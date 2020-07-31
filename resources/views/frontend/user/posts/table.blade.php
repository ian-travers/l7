@php /* @var App\Entities\Blog\Post\Post $post */ @endphp

<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>{{ __('misc.actions') }}</th>
        <th>{{ __('user.post-title') }}</th>
        <th>{{ __('user.post-excerpt') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
        <td></td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->excerpt }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

