<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExamQuestion extends Model
{
    use HasFactory;

    public static $question;
    public static function createQuestion($request)
    {
        self::$question = new ExamQuestion();
        self::$question->user_id = Auth::id();
        self::$question->exam_id = $request->exam_id;
        self::extracted($request);
    }
    public static function updateQuestion($request)
    {
        self::$question = ExamQuestion::where([
            ['id', $request->question_id],
            ['user_id',Auth::id()],
            ['exam_id', $request->exam_id]
        ])->first();
        self::extracted($request);
    }

    /**
     * @param $request
     * @return void
     */
    public static function extracted($request): void
    {
        self::$question->question = $request->question;
        self::$question->choice_one = $request->choice_one;
        self::$question->choice_two = $request->choice_two;
        self::$question->choice_three = $request->choice_three;
        self::$question->choice_four = $request->choice_four;
        self::$question->correct_answer = $request->correct_answer;
        if ($request->has('explanation')) {
            self::$question->explanation = $request->explanation;
        }
        self::$question->save();
    }

    public function answer()
    {
        return $this->hasMany(ExamAnswer::class, 'answer', 'correct_answer');
    }
    public function solution()
    {
        return $this->hasOne(ExamAnswer::class);
    }
}
