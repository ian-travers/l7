<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

trait LikingDisliking
{
    public function storeLike(Model $model)
    {
        $model->like();

        return response([
            'status' => __('flash.info'),
            'message' => __('flash.mark-liked'),
        ]);
    }

    public function removeLike(Model $model)
    {
        $model->unlike();

        return response([
            'status' => __('flash.info'),
            'message' => __('flash.unmark-liked'),
        ]);
    }

    public function storeDislike(Model $model)
    {
        $model->dislike();

        return response([
            'status' => __('flash.info'),
            'message' => __('flash.mark-disliked'),
        ]);
    }

    public function removeDislike(Model $model)
    {
        $model->undislike();

        return response([
            'status' => __('flash.info'),
            'message' => __('flash.unmark-disliked'),
        ]);
    }
}
