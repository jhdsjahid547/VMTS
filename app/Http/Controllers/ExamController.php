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
    public $exam, $courses, $timeLimits, $negativeMarks, $validCheck, $row, $passRates;

    public function settingProperty($id)
    {
        return SettingProperty::where('setting_id', $id)->pluck('id')->toArray();
    }
    public function settings($id)
    {
        return Setting::find($id)->property;
    }
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
                ->editColumn('pass_mark_id', function ($exam) {
                    return $exam->passingRate->value.'%';
                })
                ->make(true);
        }
        return view('creator.index', [
            'courses' => Course::all(),
            'timeLimits' => $this->settings(1),
            'negativeMarks' => $this->settings(2),
            'passRates' => $this->settings(3),
        ]);
    }
    public function examSubmit(Request $request)
    {
        $this->validCheck = Validator::make($request->all(), [
            'course' => 'required|exists:courses,id',
            'time_limit' => 'required|in:'.implode(",", $this->settingProperty(1)),
            'negative_mark' => 'required|in:'.implode(",", $this->settingProperty(2)),
            'passing_rate' => 'required|in:'.implode(",", $this->settingProperty(3)),
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
        $this->row = ExamQuestion::where('exam_id', $id)->get();
        return view('creator.manage-exam', [
            'exam' => Exam::find($id),
            'courses' => Course::all(),
            'timeLimits' => $this->settings(1),
            'negativeMarks' => $this->settings(2),
            'passRates' => $this->settings(3),
            'count' => $this->row->count()
        ]);
    }
    public function examActivity($id)
    {
        $this->exam = Exam::where([['id', $id], ['user_id', Auth::id()]])->first('question_limit');
        $this->questions = ExamQuestion::where([['exam_id', $id], ['user_id', Auth::id()]])->count();
        if($this->exam->question_limit != $this->questions){
            return response()->json(['success' => 'Disable. Before Start Fill Extra '.$this->exam->question_limit-$this->questions.' Question']);
        } else {
            $this->respo = Exam::activity($id);
            return response()->json(['success' => $this->respo]);
        }
    }
    public function distroy($id)
    {
        Exam::find($id)->delete();
        return response()->json(['success' => 'Successfully exam deleted']);
    }
}
