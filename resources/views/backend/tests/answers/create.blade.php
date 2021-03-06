@php /* @var App\Entities\Test\TestQuestion $question */ @endphp

<x-backend-layout :title="__('backend.new-answer')">
    <div class="card">
        <div class="card-header">
            <span class="h4">{{ __('backend.new-answer') }}</span>
            <div class="bg-secondary mx-n2 p-2">
                <p class="text-light h5">{{ $question->question }}</p>
            </div>
        </div>
        <div class="card-body">
            <form id="answer-form" action="{{ route('admin.tests.answers.store', $question) }}" method="post">

                @csrf
                @include('backend.tests.questions._answerForm')
                <button type="submit" class="btn btn-primary w-15">{{ __('misc.save') }}</button>
            </form>
        </div>
    </div>
</x-backend-layout>

