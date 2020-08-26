<?php

namespace App\Entities\Test;

use App\Entities\NativeAttributeTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Test\TestAnswer
 *
 * @property int $id
 * @property int $question_id
 * @property string $answer_en
 * @property string $answer_ru
 * @property int $index
 * @property-read string|null $answer
 * @property-read \App\Entities\Test\TestQuestion $question
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Test\TestAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Test\TestAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Test\TestAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Test\TestAnswer whereAnswerEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Test\TestAnswer whereAnswerRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Test\TestAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Test\TestAnswer whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Test\TestAnswer whereQuestionId($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
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
