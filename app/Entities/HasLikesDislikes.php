<?php


namespace App\Entities;


trait HasLikesDislikes
{
    // Likes
    public function likes()
    {
        return $this->morphMany(Like::class, 'liked')->where(['is_dislike' => false]);
    }

    public function like()
    {
        // toggle if used to dislike for current user
        if ($dislike = $this->dislikes()->where(['user_id' => auth()->id()])->first()) {
            return $dislike->toggle();
        }

        $attributes = [
            'user_id' => auth()->id(),
            'is_dislike' => false,
        ];

        if (!$this->likes()->where($attributes)->exists()) {
            return $this->likes()->create($attributes);
        }
    }

    public function unlike()
    {
        $attributes = [
            'user_id' => auth()->id(),
            'is_dislike' => false,
        ];

        if ($like = $this->likes()->where($attributes)->first()) {
            return $like->delete();
        }
    }

    public function isLiked()
    {
        return $this->likes()
            ->where([
                'user_id' => auth()->id(),
                'is_dislike' => false,
            ])
            ->exists();
    }

    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }

    // Dislikes
    public function dislikes()
    {
        return $this->morphMany(Like::class, 'liked')->where(['is_dislike' => true]);
    }

    public function dislike()
    {
        // toggle if used to like for current user
        if ($like = $this->likes()->where(['user_id' => auth()->id()])->first()) {
            return $like->toggle();
        }

        $attributes = [
            'user_id' => auth()->id(),
            'is_dislike' => true,
        ];

        if (!$this->dislikes()->where($attributes)->exists()) {
            return $this->dislikes()->create($attributes);
        }
    }

    public function undislike()
    {
        $attributes = [
            'user_id' => auth()->id(),
            'is_dislike' => true,
        ];

        if ($dislike = $this->dislikes()->where($attributes)->first()) {
            return $dislike->delete();
        }
    }

    public function isDisliked()
    {
        return $this->dislikes()
            ->where([
                'user_id' => auth()->id(),
                'is_dislike' => true,
            ])
            ->exists();
    }

    public function getIsDislikedAttribute()
    {
        return $this->isDisliked();
    }
}
