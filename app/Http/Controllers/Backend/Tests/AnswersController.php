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

    public function store(TestQuestion $question)
    {
        $question->addAnswer(request('answer_en'), request('answer_ru'), request('index'));

        return redirect()->route('admin.tests.questions.show', $question);
    }

    public function edit(TestQuestion $question, TestAnswer $answer)
    {

    }

    public function update(TestQuestion $question, TestAnswer $answer)
    {
        $question->editAnswer($answer->id, request('answer_en'), request('answer_ru'), request('index'));

        return redirect()->route('admin.tests.questions.show', $question);
    }

    public function remove(TestQuestion $question, TestAnswer $answer)
    {
        $question->removeAnswer($answer->id);

        return redirect()->route('admin.tests.questions.show', $question);
    }
}
