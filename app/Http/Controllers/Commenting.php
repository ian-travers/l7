<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

trait Commenting
{
    /**
     * @param Model $model
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function publishComment(Model $model)
    {
        $formData = $this->validateRequest();

        if ($formData['parent_id'] == $model->id) {
            return redirect()->back()->with('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.wrong-parent'),
            ]));
        }

        $model->comment($formData['body'], auth()->user(), $formData['parent_id']);

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.comment-added'),
        ]));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRequest()
    {
        return $this->validate(request(), [
            'body' => 'required',
            'parent_id' => 'nullable|exists:comments,id',
        ]);
    }
}
