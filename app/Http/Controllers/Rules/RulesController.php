<?php

namespace App\Http\Controllers\Rules;

use App\Entities\Test\TestQuestion;
use App\Http\Controllers\Controller;

class RulesController extends Controller
{
    public function show()
    {
        $questions = TestQuestion::all();

        return view('frontend.rules.show', compact('questions'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function check()
    {
        $this->validate(request(), [
            'quiz-form' => 'required',
        ]);

        $errorsCount = TestQuestion::count() - count(request('quiz-form'));

        foreach (request('quiz-form') as $q => $a) {
            $question = TestQuestion::findOrFail($q);

            if (!$question->isCorrectAnswer($a)) {
                $errorsCount++;
            }
        }

        if ($errorsCount) {
            return back()->with('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('rules.quiz-failed', ['count' => $errorsCount]),
            ]));
        }

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('rules.quiz-passed'),
        ]));
    }
}
