<?php

namespace App\Entities\Test;

use App\Entities\NativeAttributeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Test\TestAnswer
 *
 * @property int $id
 * @property int $question_id
 * @property string $answer_en
 * @property string $answer_ru
 * @property int $index
 * @property-read \App\Entities\Test\TestQuestion $question
 * @method static Builder|TestAnswer newModelQuery()
 * @method static Builder|TestAnswer newQuery()
 * @method static Builder|TestAnswer query()
 * @method static Builder|TestAnswer whereAnswerEn($value)
 * @method static Builder|TestAnswer whereAnswerRu($value)
 * @method static Builder|TestAnswer whereId($value)
 * @method static Builder|TestAnswer whereIndex($value)
 * @method static Builder|TestAnswer whereQuestionId($value)
 * @mixin \Eloquent
 */
class TestAnswer extends Model
{
    use NativeAttributeTrait;

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

    /**
     * @return string|null
     */
    public function getAnswerAttribute()
    {
        return $this->GetNativeAttributeValue('answer');
    }
}
