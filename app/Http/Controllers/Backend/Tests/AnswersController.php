<?php

namespace App\Http\Controllers\Backend\Tests;

use App\Entities\Test\TestAnswer;
use App\Entities\Test\TestQuestion;
use App\Http\Controllers\Controller;

class AnswersController extends Controller
{
    public function create(TestQuestion $question)
    {

    }

    /**
     * @param TestQuestion $question
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(TestQuestion $question)
    {
        $answer = $this->validateRequest();
        $question->addAnswer($answer['answer_en'], $answer['answer_ru'], $answer['index']);

        return redirect()->route('admin.tests.questions.show', $question);
    }

    public function edit(TestQuestion $question, TestAnswer $answer)
    {

    }

    /**
     * @param TestQuestion $question
     * @param TestAnswer $answer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(TestQuestion $question, TestAnswer $answer)
    {
        $updAnswer = $this->validateRequest();
        $question->editAnswer($answer->id, $updAnswer['answer_en'], $updAnswer['answer_ru'], $updAnswer['index']);

        return redirect()->route('admin.tests.questions.show', $question);
    }

    public function remove(TestQuestion $question, TestAnswer $answer)
    {
        $question->removeAnswer($answer->id);

        return redirect()->route('admin.tests.questions.show', $question);
    }

    /**
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateRequest()
    {
        return $this->validate(request(), [
            'answer_en' => 'required|string|max:255',
            'answer_ru' => 'required|string|max:255',
            'index' => 'required|string|max:1|regex:/^[1-9]{1}$/s',
        ]);
    }
}
