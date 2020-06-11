@php /** @var App\Entities\Test\TestQuestion $question */ @endphp

<x-frontend-layout :title="__('test.racer')">
    <div class="container">
        <p class="text-info h2 text-center">{{ __('test.racer') }}</p>
        <p class="text-info lead">{!! __('test.racer-intro', ['url' => '#']) !!}</p>

        <form action="{{ route('tests.check-racer-test') }}" method="post">

            @csrf
            @foreach($questions as $question)
                <div class="p-2 border border-nfsu-cup text-info">
                    <p class="lead">{{ $question->question }}</p>

                    @foreach($question->answers->shuffle() as $answer)
                        <div class="form-check">
                            <input
                                id="{{ $answer->id }}"
                                class="form-check-input pl-3"
                                type="radio"
                                name="test-form[{{ $question->id }}]"
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
</x-frontend-layout>

