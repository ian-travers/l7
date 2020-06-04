<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th class="w-10">{{ __('backend.index') }}</th>
        <th>{{ __('backend.answer_en') }}</th>
        <th>{{ __('backend.answer_ru') }}</th>
        <th class="w-10">{{ __('misc.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($question->answers as $answer)
        <tr>
            <td class="text-center">{{ $answer->index }}</td>
            <td>{{ $answer->answer_en }}</td>
            <td>{{ $answer->answer_ru }}</td>
            <td class="text-center">
                <a href="#" class="btn btn-primary btn-sm fa fa-edit" title="{{ __('misc.edit') }}"></a>
                <form class="d-inline" action="#" method="post">

                    @method('delete')
                    @csrf
                    <button type="submit" onclick="return confirm('{{ __('misc.confirm-delete') }}')"
                            class="btn btn-danger btn-sm fa fa-trash" title={{ __('misc.delete') }}></button>
                </form>
            </td>
        </tr>


    @empty
        {{ __('backend.tests.answers-not-found') }}
    @endforelse
    </tbody>

</table>

