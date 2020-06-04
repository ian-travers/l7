<x-backend-layout :title="__('backend.show-question')">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <x-dashboard-left-menu/>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="align-items-center">
                                <span class="h3">{{ __('backend.show-question') }}</span>
                                <a href="{{ route('admin.tests.questions.edit', $question) }}" class="btn btn-sm btn-primary mt-n2">{{ __('misc.edit') }}</a>
                                <form class="d-inline" action="{{ route('admin.tests.questions.delete', $question) }}" method="post">

                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="return confirm('{{ __('misc.confirm-delete') }}')"
                                            class="btn btn-danger btn-sm mt-n2">{{ __('misc.delete') }}</button>
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('admin.tests.questions') }}" class="btn btn-sm btn-primary">{{ __('backend.tests.questions') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th>{{ __('backend.question_en') }}</th>
                                <td>{{ $question->question_en }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('backend.question_ru') }}</th>
                                <td>{{ $question->question_ru }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('backend.correct_answer') }}</th>
                                <td>{{ $question->correct_answer }}</td>
                            </tr>
                        </table>
                        <h4>{{ __('backend.answer-options') }}</h4>
                        <a href="#" class="btn btn-sm btn-success">{{ __('misc.create') }}</a>

                        <div>
                            @include('backend.tests.answers.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>





