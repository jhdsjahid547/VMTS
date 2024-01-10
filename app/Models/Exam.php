<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use HasFactory;

    public static $exam, $message;
    public static function createExam($request)
    {
        self::$exam = new Exam();
        self::$exam->user_id = Auth::id();
        self::extracted($request);
    }
    public static function updateExam($request, $id)
    {
        self::$exam = Exam::where([
            ['id', $id],
            ['user_id', Auth::id()]
        ])->first();
        self::extracted($request);
    }
    public static function activity($id)
    {
        self::$exam = Exam::find($id);
        if (self::$exam->status == 1){
            self::$exam->status = 0;
            self::$message = 'disable';
        } else {
            self::$exam->status = 1;
            if (self::$exam->activity == 0) {
                self::$exam->activity = 1;
            }
            self::$message = 'active';
        }
        self::$exam->save();
        return self::$message;
    }
    public static function resultPublish($id)
    {
        self::$exam = Exam::find($id);
        if (self::$exam->publish == 1){
            self::$exam->publish = 0;
            self::$message = 'unpublished';
        } else {
            self::$exam->publish = 1;
            self::$message = 'published';
        }
        self::$exam->save();
        return self::$message;
    }
    /**
     * @param $request
     * @return void
     */
    public static function extracted($request): void
    {
        self::$exam->course_id = $request->course;
        self::$exam->time_limit_id = $request->time_limit;
        self::$exam->negative_mark_id = $request->negative_mark;
        self::$exam->title = $request->title;
        self::$exam->question_limit = $request->question_limit;
        self::$exam->pass_mark_id = $request->passing_rate;
        self::$exam->description = $request->description;
        self::$exam->save();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function negativeMark()
    {
        return $this->belongsTo(SettingProperty::class, 'negative_mark_id');
    }
    public function timeLimit()
    {
        return $this->belongsTo(SettingProperty::class, 'time_limit_id');
    }
    public function passingRate()
    {
        return $this->belongsTo(SettingProperty::class, 'pass_mark_id');
    }
    public function attempt()
    {
        return $this->hasMany(ExamAttempt::class);
    }
    public function singleAttempt()
    {
        return $this->hasOne(ExamAttempt::class);
    }
}
