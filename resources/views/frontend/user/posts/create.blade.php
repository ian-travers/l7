@php /** @var App\Entities\Blog\Post\Post $post */ @endphp

<x-user-layout :title="__('post.create')">
    <div class="card">
        <div class="card-header">
            <span class="h3 d-block">{{ __('user.create-post') }}</span>
        </div>
        <div class="card-body">
            <form id="post-form" action="{{ route('user.posts.store') }}" method="post">
                @csrf
                @include('frontend.user.posts._form')
                <button type="submit" class="btn btn-primary w-15">{{ __('misc.save') }}</button>
            </form>
        </div>
    </div>
</x-user-layout>

