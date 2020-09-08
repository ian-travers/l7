<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

trait Commenting
{
    /**
     * @param Model $model
     *
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public function publishComment(Model $model)
    {
        $formData = $this->validateRequest();

        if ($formData['parent_id'] == $model->id) {
            return false;
        }

        return (bool)$model->comment($formData['body'], auth()->user(), $formData['parent_id']);
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
