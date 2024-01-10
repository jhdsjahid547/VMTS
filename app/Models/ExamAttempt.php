<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExamAttempt extends Model
{
    use HasFactory;
    public static $attempt;
    public static function addAttempt($id, $status, $totalAnswered, $correct, $wrong, $result)
    {
        self::$attempt = new ExamAttempt();
        self::$attempt->user_id = Auth::id();
        self::$attempt->exam_id = $id;
        self::$attempt->total_answered = $totalAnswered;
        self::$attempt->correct_answer = $correct;
        self::$attempt->wrong_answer = $wrong;
        self::$attempt->result = $result;
        self::$attempt->status = $status;
        self::$attempt->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
