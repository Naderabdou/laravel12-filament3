<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $question_ar
 * @property string $question_en
 * @property string $answer_ar
 * @property string $answer_en
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
    ];

    public function getQuestionAttribute(): string
    {
        return $this['question_' . app()->getLocale()];
    }
    public function getAnswerAttribute(): string
    {
        return $this['answer_' . app()->getLocale()];
    }
}
