<?php

namespace App\Http\Controllers\Tests;

use App\Entities\Test\TestQuestion;
use App\Http\Controllers\Controller;

class TestsController extends Controller
{
    public function racerTest()
    {
        return view('frontend.tests.racer', [
            'questions' => TestQuestion::getRacerTestQuestions()
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkRacerTest()
    {
        $this->validate(request(), [
            'test-form' => 'required',
        ]);

        // by default the test has 6 questions
        // It can be changed in function racerTest() (see above)
        $errorsCount = 6 - count(request('test-form'));

        foreach (request('test-form') as $q => $a) {
            $question = TestQuestion::findOrFail($q);

            if (!$question->isCorrectAnswer($a)) {
                $errorsCount++;
            }
        }

        if ($errorsCount) {
            return back()->with('flash', json_encode([
                'type' => 'error',
                'title' => __('flash.error'),
                'message' => __('test.test-failed', ['count' => $errorsCount]),
            ]));
        }

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('test.test-passed'),
        ]));
    }
}
