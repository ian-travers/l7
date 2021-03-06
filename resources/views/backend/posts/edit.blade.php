@php /** @var App\Entities\Blog\Post\Post $post */ @endphp

<x-backend-layout :title="__('user.edit-post')">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <span class="h3">{{ __('user.edit-post') }}</span>

                <span class="small"><span class="required-field"></span>&nbsp;&mdash;&nbsp;{{ __('user.required-fields') }}</span>
            </div>
        </div>
        <div class="card-body">
            <form id="post-form" action="{{ route('admin.posts.update', ['post' => $post, 'page' => request()->query('page')]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                @include('backend.posts._form')
                <button type="submit" class="btn btn-primary w-15">{{ __('misc.update') }}</button>
            </form>
        </div>
    </div>
</x-backend-layout>

