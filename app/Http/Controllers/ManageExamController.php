<?php

namespace App\Http\Controllers;

use App\Models\AssignCourse;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\SettingProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Rules\Uncommon;

class ManageExamController extends Controller
{
    public $validCheck, $questions, $exam;
    //Configuration for getting setting property like, time limits, negative marks, passing rate
    public function settingProperty($id)
    {
        return SettingProperty::where('setting_id', $id)->pluck('id')->toArray();
    }
    //Responsible for update exam panel
    public function update(Request $request, $id)
    {
        $this->validCheck = Validator::make($request->all(), [
            'global' => 'boolean',
            'publish' => 'boolean',
            'course' => 'required|exists:courses,id|in:'.AssignCourse::where('user_id', Auth::id())->first()->course_id,
            'time_limit' => 'required|in:'.implode(",", $this->settingProperty(1)),
            'negative_mark' => 'required|in:'.implode(",", $this->settingProperty(2)),
            'passing_rate' => 'required|in:'.implode(",", $this->settingProperty(3)),
            'title' => 'required|min:3',
            'question_limit' => 'required',
        ]);
        if($this->validCheck->passes()) {
            Exam::updateExam($request, $id);
            return response()->json(['success' => 'Successfully exam panel updated']);
        }
        return response()->json(['invalid' => $this->validCheck->errors()]);
    }
    //Responsible for create and update question
    public function createQuestion(Request $request)
    {
        $this->validCheck = Validator::make($request->all(), [
            'exam_id' => 'required|exists:exams,id',
            'question' => ['required', new Uncommon()],
            'choice_one' => 'required|different:choice_two|different:choice_three|different:choice_four',
            'choice_two' => 'required|different:choice_one|different:choice_three|different:choice_four',
            'choice_three' => 'required|different:choice_one|different:choice_two|different:choice_four',
            'choice_four' => 'required|different:choice_one|different:choice_two|different:choice_three',
            'explanation' => 'string|nullable|max:100',
            'correct_answer' => 'required|in:'.implode(",", [
                $request->choice_one,
                $request->choice_two,
                $request->choice_three,
                $request->choice_four,
            ]),
        ]);
        if($this->validCheck->passes()) {
            if ($request->filled('question_id')) {
                ExamQuestion::updateQuestion($request);
                return response()->json(['success' => 'Successfully question updated']);
            } else {
                $this->exam = Exam::where([['id', $request->exam_id], ['user_id', Auth::id()]])->first('question_limit');
                $this->questions = ExamQuestion::where([['exam_id', $request->exam_id], ['user_id', Auth::id()]])->count();
                if($this->exam->question_limit == $this->questions){
                    return response()->json(['success' => 'Limit Reached!']);
                } else {
                    ExamQuestion::createQuestion($request);
                    return response()->json(['cr' => true, 'success' => 'Successfully question created']);
                }
            }
        }
        return response()->json(['invalid' => $this->validCheck->errors()]);
    }
    //Fetching data to update modal box
    public function showUpdateQuestion($id)
    {
        $this->questions = ExamQuestion::find($id);
        return response()->json($this->questions);
    }
    //Responsible for showing questions for right side
    public function questionSet($id)
    {
        return DataTables::of(ExamQuestion::where('exam_id', $id)->orderBy('id', 'desc')->get())
            ->addColumn('action', 'action')
            ->addColumn('questions', function ($examQuestion) {
                return [
                    'question' => $examQuestion->question,
                    'correct' => $examQuestion->correct_answer,
                    'choice' => [
                        'A' => $examQuestion->choice_one,
                        'B' => $examQuestion->choice_two,
                        'C' => $examQuestion->choice_three,
                        'D' => $examQuestion->choice_four,
                    ],
                    'explanation' => $examQuestion->explanation,
                ];
            })
            ->addIndexColumn()
            ->make(true);
    }
    //Delete question
    public function distroy($id)
    {
        ExamQuestion::find($id)->delete();
        return response()->json(['success' => 'Successfully question deleted']);
    }
}
