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
                <div class="d-flex justify-content-between align-items-end">
                    <div class="d-flex justify-content-between align-items-end">
                        <button type="submit" class="btn btn-lg btn-primary mr-2">{{ __('misc.update') }}</button>
                        <a href="{{ route('admin.tests.questions') }}" class="btn btn-sm btn-secondary">{{ __('misc.cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-backend-layout>



