@php /* @var App\Entities\Test\TestQuestion $question */ @endphp

<x-backend-layout :title="__('backend.new-answer')">
    <div class="card">
        <div class="card-header">
            <span class="h4">{{ __('backend.new-answer') }}</span>
            <div class="bg-secondary mx-n2 p-2">
                <p class="text-light h5 mt-2">{{ $question->question_en }}</p>
                <p class="text-light h5">{{ $question->question_ru }}</p>
            </div>
        </div>
        <div class="card-body">
            <form id="answer-form" action="{{ route('admin.tests.answers.store', $question) }}" method="post">

                @csrf
                @include('backend.tests.questions._answerForm')
                <div>
                    <button type="submit" class="btn btn-primary">{{ __('misc.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-backend-layout>

