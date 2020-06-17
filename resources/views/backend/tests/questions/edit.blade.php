<x-backend-layout :title="__('backend.edit-question')">
    <div class="card">
        <div class="card-header">
            <span class="h3 d-block">{{ __('backend.edit-question') }}</span>
        </div>
        <div class="card-body">
            <form id="question-form" action="{{ route('admin.tests.questions.update', $question) }}" method="post">

                @csrf
                @method('patch')
                @include('backend.tests.questions._form')
                <button type="submit" class="btn btn-primary">{{ __('misc.update') }}</button>
            </form>
        </div>
    </div>
</x-backend-layout>



