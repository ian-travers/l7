<x-backend-layout :title="__('backend.new-question')">
    <div class="card">
        <div class="card-header">
            <span class="h3 d-block">{{ __('backend.new-question') }}</span>
        </div>
        <div class="card-body">
            <form id="question-form" action="{{ route('admin.tests.questions.store') }}" method="post">

                @csrf
                @include('backend.tests.questions._form')
                <button type="submit" class="btn btn-primary w-15">{{ __('misc.save') }}</button>
            </form>
        </div>
    </div>
</x-backend-layout>

