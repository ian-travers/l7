<?php

namespace App\Entities\Test;

use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(TestQuestion::class);
    }

    public function edit(string $answerEn, string $answerRu, string $index): void
    {
        $this->update([
            'answer_en' =>$answerEn,
            'answer_ru' =>$answerRu,
            'index' => $index,
        ]);
    }
}
