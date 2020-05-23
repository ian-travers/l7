<?php

namespace App\Entities\Test;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Test\TestQuestion
 *
 * @property int $id
 * @property string $question_en
 * @property string $question_ru
 * @property int $correct_answer
 * @method static Builder|TestQuestion newModelQuery()
 * @method static Builder|TestQuestion newQuery()
 * @method static Builder|TestQuestion query()
 * @method static Builder|TestQuestion whereCorrectAnswer($value)
 * @method static Builder|TestQuestion whereId($value)
 * @method static Builder|TestQuestion whereQuestionEn($value)
 * @method static Builder|TestQuestion whereQuestionRu($value)
 * @mixin \Eloquent
 */
class TestQuestion extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public static function new(string $questionEn, string $questionRu, int $correctAnswer): self
    {
        return self::create([
            'question_en' => $questionEn,
            'question_ru' => $questionRu,
            'correct_answer' => $correctAnswer,
        ]);
    }

    public function edit(string $questionEn, string $questionRu, int $correctAnswer): void
    {
        $this->update([
            'question_en' => $questionEn,
            'question_ru' => $questionRu,
            'correct_answer' => $correctAnswer,
        ]);
    }
}
