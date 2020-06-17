<x-backend-layout :title="__('backend.edit-page')">
    <div class="card">
        <div class="card-header">
            <span class="h3 d-block">{{ __('backend.edit-page') }}</span>
        </div>
        <div class="card-body">
            <form id="question-form" action="{{ route('admin.pages.update', $page) }}" method="post">

                @csrf
                @method('patch')
                @include('backend.pages._form')
                <button type="submit" class="btn btn-primary w-15">{{ __('misc.update') }}</button>
            </form>
        </div>
    </div>
</x-backend-layout>

