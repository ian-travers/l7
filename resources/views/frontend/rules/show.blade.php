@php /** @var App\Entities\Test\TestQuestion $question */ @endphp

<x-frontend-layout :title="__('rules.rules')">
    <div class="container text-info">
        <p class="h1 text-center">@lang('rules.h1-title')</p>
        <div class="row">
            <div class="col-md-7">
                <p class="h3 text-center">@lang('rules.left-col-title')</p>
                <h4>@lang('rules.h4-01')</h4>
                <p>@lang('rules.p-01-01')</p>
                <p>@lang('rules.p-01-02')</p>
                <p>@lang('rules.p-01-03')</p>
                <p>@lang('rules.p-01-04')</p>
                <p>@lang('rules.p-01-05')</p>
                <p>@lang('rules.p-01-06')</p>
                <p>@lang('rules.p-01-07')</p>
                <h4>@lang('rules.h4-02')</h4>
                <p>@lang('rules.p-02-01')</p>
                <p>@lang('rules.p-02-02')</p>
                <h4>@lang('rules.h4-03')</h4>
                <p>@lang('rules.p-03-01')</p>
                <p>@lang('rules.p-03-02')</p>
                <p>@lang('rules.p-03-03')</p>
                <p>@lang('rules.p-03-04')</p>
                <p>@lang('rules.p-03-05')</p>
                <h4>@lang('rules.h4-04')</h4>
                <p>@lang('rules.p-04-01')</p>
                <p>@lang('rules.p-04-02')</p>
                <h4>@lang('rules.h4-05')</h4>
                <p>@lang('rules.p-05-01')</p>
                <p>@lang('rules.p-05-02')</p>
            </div>
            <div class="col-md-5 border-left border-info">
                <p class="h3 text-center">@lang('rules.right-col-title')</p>
                <p class="lead">Try to answer on these questions and check your understanding of the rules:</p>
                <form action="{{ route('rules.rules-check') }}" method="post">

                    @csrf
                    @foreach($questions as $question)
                        <div class="p-2">
                            <p class="h5">{{ $question->question }}</p>

                            @foreach($question->answers->shuffle() as $answer)
                                <div class="form-check">
                                    <input
                                        id="{{ $answer->id }}"
                                        class="form-check-input pl-3"
                                        type="radio"
                                        name="quiz-form[{{ $question->id }}]"
                                        value="{{$answer->index}}"
                                    >
                                    <label class="form-check-label" for="{{ $answer->id }}">
                                        {{ $answer->answer }}
                                    </label>
                                </div>

                            @endforeach
                        </div>

                    @endforeach
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">{{ __('test.check') }}</button>
                    </div>
                </form>
            </div>
        </div>'
    </div>

</x-frontend-layout>



