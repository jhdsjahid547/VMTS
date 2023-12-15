<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamAttempt;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public $exam, $result, $id, $questions;
    public function showResult($id)
    {
        $this->result = ExamAttempt::where([['user_id', Auth::id()], ['exam_id', $id], ['status', 1]])->first();
        $this->exam = Exam::find($id)->first();
        $this->id = ExamAnswer::where([['user_id', Auth::id()], ['exam_id', $id]])->pluck('exam_question_id')->toArray();
        $this->questions = ExamQuestion::where('exam_id', $id)->whereIn('id', $this->id)->get();
        return view('subscriber.show-result', ['exam' => $this->exam, 'result' => $this->result, 'questions' => $this->questions]);
    }
}
