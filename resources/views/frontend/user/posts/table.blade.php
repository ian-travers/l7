<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>{{ __('misc.actions') }}</th>
        <th>{{ __('user.post-title') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
        <td></td>
        <td>{{ $post->title }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

