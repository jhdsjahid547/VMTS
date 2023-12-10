<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Setting;
use App\Models\SettingProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public $exam, $courses, $timeLimits, $negativeMarks, $validCheck, $row;

    public function index(Request $request)
    {
        if($request->ajax()) {
            return datatables()->of(Exam::where('user_id', Auth::id())->get())
                ->addColumn('action', 'action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->editColumn('course_id', function ($exam) {
                    return $exam->course->name;
                })
                ->editColumn('negative_mark_id', function ($exam) {
                    return $exam->negativeMark->value.' Mark';
                })
                ->editColumn('time_limit_id', function ($exam) {
                    return $exam->timeLimit->value.' Minute';
                })
                ->make(true);
        }
        $this->courses = Course::all();
        $this->timeLimits = Setting::find(1)->property;
        $this->negativeMarks = Setting::find(2)->property;
        return view('creator.index', [
            'courses' => $this->courses,
            'timeLimits' => $this->timeLimits,
            'negativeMarks' => $this->negativeMarks,
        ]);
    }
    public function examSubmit(Request $request)
    {
        $this->timeLimits = SettingProperty::where('setting_id',1)->pluck('id')->toArray();
        $this->negativeMarks = SettingProperty::where('setting_id',2)->pluck('id')->toArray();
        $this->validCheck = Validator::make($request->all(), [
            'course' => 'required|exists:courses,id',
            'time_limit' => 'required|in:'.implode(",", $this->timeLimits),
            'negative_mark' => 'required|in:'.implode(",", $this->negativeMarks),
            'title' => 'required|min:3',
            'question_limit' => 'required',
        ]);
        if($this->validCheck->passes()) {
            Exam::createExam($request);
            return response()->json(['success' => 'Successfully exam panel created']);
        }
        return response()->json(['invalid' => $this->validCheck->errors()]);
    }
    public function manage($id)
    {
        $this->exam = Exam::find($id);
        $this->courses = Course::all();
        $this->timeLimits = Setting::find(1)->property;
        $this->negativeMarks = Setting::find(2)->property;
        $this->row = ExamQuestion::where('exam_id', $id)->get();
        return view('creator.manage-exam', [
            'exam' => $this->exam,
            'courses' => $this->courses,
            'timeLimits' => $this->timeLimits,
            'negativeMarks' => $this->negativeMarks,
            'count' => $this->row->count()
        ]);
    }
    public function examActivity($id)
    {
        $this->respo = Exam::activity($id);
        return response()->json(['success' => $this->respo]);
    }
    public function distroy($id)
    {
        Exam::find($id)->delete();
        return response()->json(['success' => 'Successfully exam deleted']);
    }
}
