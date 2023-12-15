<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExamAnswer extends Model
{
    use HasFactory;
    public static $questionForm;
    public static function answerSubmit($request, $id)
    {
        foreach ($request->answer as $question_id => $call) {
            self::$questionForm = new ExamAnswer();
            self::$questionForm->user_id = Auth::id();
            self::$questionForm->exam_id = $id;
            self::$questionForm->exam_question_id = $question_id;
            self::$questionForm->answer = $call['correct'];
            self::$questionForm->save();
        }
        return self::$questionForm;
    }
    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'exam_question_id');
    }
}
