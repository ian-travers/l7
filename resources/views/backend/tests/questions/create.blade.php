<x-backend-layout :title="__('backend.new-question')">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <x-dashboard-left-menu/>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <span class="h3 d-block">{{ __('backend.new-question') }}</span>
                    </div>
                    <div class="card-body">
                        <form id="question-form" action="{{ route('admin.tests.questions.store') }}" method="post">

                            @csrf
                            @include('backend.tests.questions._form')
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="d-flex justify-content-between align-items-end">
                                    <button type="submit" class="btn btn-lg btn-primary mr-2">{{ __('misc.save') }}</button>
                                    <a href="{{ route('admin.tests.questions') }}" class="btn btn-sm btn-secondary">{{ __('misc.cancel') }}</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>

