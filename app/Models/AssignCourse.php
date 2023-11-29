<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCourse extends Model
{
    use HasFactory;

    public static $assignCourse;
    public static function studentCourse($request, $user_id)
    {
        self::$assignCourse = new AssignCourse();
        self::$assignCourse->course_id = $request->course_id;
        self::$assignCourse->user_id = $user_id;
        self::$assignCourse->save();
    }

    public static function updateUserCourse($request)
    {
        self::$assignCourse = AssignCourse::where('user_id', $request->id)->first();
        self::$assignCourse->course_id = $request->course_id;
        self::$assignCourse->save();
    }

    public function topic()
    {
        return $this->belongsTo(Course::class);
    }
    public function userInfo()
    {
        return $this->belongsTo(User::class);
    }
}
