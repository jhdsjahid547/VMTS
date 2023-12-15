<?php

namespace App\Http\Controllers;

use App\Models\AssignCourse;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamAttempt;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableExamController extends Controller
{
    public $exams, $course, $questions, $answerCount, $answer, $attempt, $message, $totalAnswered, $correctAnswered, $wrongAnswered, $result;
    public function index()
    {
        $this->course = AssignCourse::where('user_id', Auth::id())->first('course_id');
        $this->exams = Exam::where([
            ['course_id', $this->course->course_id],
            ['status', 1],
        ])->get();
        $this->attempt = ExamAttempt::all();
        return view('subscriber.index', ['exams' => $this->exams, 'attempts' => $this->attempt]);
    }
    public function take($id)
    {
        $this->questions = ExamQuestion::where('exam_id', $id)->inRandomOrder()->get();
        return view('subscriber.question-paper', ['exam' => Exam::find($id), 'questions' => $this->questions, 'i' => 0]);
    }

    public function submit(Request $request, $id)
    {
        //here $id has exam_id
        $this->attempt = ExamAttempt::where([['user_id', Auth::id()], ['exam_id', $id]]);
        $this->answerCount = ExamAnswer::where([['user_id', Auth::id()], ['exam_id', $id]]);
        $this->questions = ExamQuestion::where('exam_id', $id)->pluck('correct_answer')->toArray();
        $this->exams = Exam::find($id)->first();
        if ($this->attempt->count() > 0){
            $this->message = 'attempted';
        } else if ($this->answerCount->count() == 0) {
            if (is_array($request->answer)) {
                $this->extracted($request, $id);
                $this->message = 'submitted';
            } else {
                ExamAttempt::addAttempt($id, 0, 0, 0, 0, 0);
                $this->message = 'attempt';
            }
        }  else if ($this->answerCount->count() > 0) {
            $this->answer = ExamAnswer::where([['user_id', Auth::id()], ['exam_id', $id]])->update(['status' => 0]);
            if (is_array($request->answer)) {
                if ($this->answer) {
                    $this->extracted($request, $id);
                }
                $this->message = 'resubmit';
            } else {
                ExamAttempt::addAttempt($id, 0, 0, 0, 0, 0);
                $this->message = 'reattempt';
            }
        }
    return response()->json(['success' => $this->message]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return void
     */
    public function extracted(Request $request, $id): void
    {
        ExamAnswer::answerSubmit($request, $id);
        $this->totalAnswered = $this->answerCount->where('status', 1)->count();
        $this->correctAnswered = $this->answerCount->whereIn('answer', $this->questions)->where('status', 1)->count();
        $this->wrongAnswered = $this->totalAnswered - $this->correctAnswered;
        /*ExamAnswer::whereNotIn('answer', $this->questions)->count()*/
        $this->result = $this->totalAnswered - ($this->wrongAnswered * $this->exams->negativeMark->value);
        ExamAttempt::addAttempt($id, 1, $this->totalAnswered, $this->correctAnswered, $this->wrongAnswered, $this->result);
    }
}
