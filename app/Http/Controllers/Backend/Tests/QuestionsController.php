<?php

namespace App\Http\Controllers\Backend\Tests;

use App\Entities\Test\TestQuestion;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = TestQuestion::paginate(20);

        return view('backend.tests.questions.index', compact('questions'));
    }

    public function create()
    {
        $question = new TestQuestion();

        return view('backend.tests.questions.create', compact('question'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        TestQuestion::create($this->validateRequest());

        return redirect()->route('admin.tests.questions')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.question-saved'),
        ]));
    }

    public function edit(TestQuestion $question)
    {
        return view('backend.tests.questions.edit', compact('question'));
    }

    /**
     * @param TestQuestion $question
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(TestQuestion $question)
    {
        $question->update($this->validateRequest());

        return redirect()->route('admin.tests.questions')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.question-updated'),
        ]));
    }

    /**
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateRequest()
    {
        return $this->validate(request(), [
            'question_en' => 'required|string|max:255',
            'question_ru' => 'required|string|max:255',
            'correct_answer' => 'required|string|max:1|regex:/^[1-9]{1}$/s',
        ]);
    }
}
