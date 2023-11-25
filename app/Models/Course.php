<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public static $course;
    public static function createCourse($request)
    {
        self::$course = new Course();
        self::$course->name =$request->name;
        self::$course->code =$request->code;
        self::$course->save();
    }
    public static function updateCourse($request)
    {
        self::$course = Course::find($request->id);
        self::$course->name =$request->name;
        self::$course->code =$request->code;
        self::$course->save();
    }
}
