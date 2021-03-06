@php /** @var App\Entities\Blog\Post\Post $post */ @endphp

<x-user-layout :title="__('user.create-post')">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <span class="h3">{{ __('user.create-post') }}</span>

                <span class="small"><span class="required-field"></span>&nbsp;&mdash;&nbsp;{{ __('user.required-fields') }}</span>
            </div>
        </div>
        <div class="card-body">
            <form id="post-form" action="{{ route('user.posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('frontend.user.posts._form')
                <button type="submit" class="btn btn-primary w-15">{{ __('misc.save') }}</button>
            </form>
        </div>
    </div>
{{--    <div class="text-center">--}}
{{--        <img src="{{ asset('blogs/ttuSokfvGGXMJPDqYlqYRJgKIg7lJK2tkRNswXkO.jpeg') }}" alt="">--}}
{{--    </div>--}}
</x-user-layout>

