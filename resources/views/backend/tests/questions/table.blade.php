@php /* @var App\Entities\Test\TestQuestion $question */ @endphp

<table class="table table-sm table-bordered mb-0">
    <thead>
    <tr>
        <th class="text-center stick-top w-10">{{ __('misc.actions') }}</th>
        <th class="stick-top">{{ __('backend.question_en') }}</th>
        <th class="stick-top">{{ __('backend.question_ru') }}</th>
        <th class="text-center stick-top w-10">{{ __('backend.correct_answer') }}</th>
        <th class="text-center stick-top w-10">{{ __('backend.ID') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($questions as $question)
        <tr>
            <td class="text-center">
                <a href="#" class="btn btn-primary btn-sm fa fa-edit" title="{{ __('misc.edit') }}"></a>
                <form class="d-inline" action="#" method="post">

                    @method('delete')
                    @csrf
                    <button type="submit" onclick="return confirm('{{ __('misc.confirm-delete') }}')"
                            class="btn btn-danger btn-sm fa fa-trash" title={{ __('misc.delete') }}></button>
                </form>
            </td>
            <td>{{ $question->question_en }}</td>
            <td>{{ $question->question_ru }}</td>
            <td class="text-center">{{ $question->correct_answer }}</td>
            <td class="text-center">{{ $question->id }}</td>
        </tr>

    @endforeach
    </tbody>
</table>


