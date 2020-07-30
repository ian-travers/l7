<x-user-layout :title="__('post.index')">
    <div class="card">
        <div class="card-header">
            <span class="h2 d-block">{{ __('user.posts') }}</span>
            <a href="{{ route('user.posts.create') }}" class="btn btn-success">{{ __('misc.create') }}</a>
        </div>
        <div class="card-body pb-0">
            @if($posts->total())
                @include('frontend.user.posts.table')
                <div>
                    {{ $posts->appends(request()->except('page'))->links() }}
                </div>

            @else
                <p>{{ __('user.posts-not-found') }}</p>
            @endif
        </div>
    </div>
</x-user-layout>

