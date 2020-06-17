<x-backend-layout :title="__('backend.new-page')">
    <div class="card">
        <div class="card-header">
            <span class="h3 d-block">{{ __('backend.new-page') }}</span>
        </div>
        <div class="card-body">
            <form id="question-form" action="{{ route('admin.pages.store') }}" method="post">

                @csrf
                @include('backend.pages._form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('misc.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-backend-layout>

