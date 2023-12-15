<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function index()
    {
        $id = ExamAnswer::where('exam_id', 6)->pluck('exam_question_id')->toArray();
        $ques = ExamQuestion::where('exam_id', 6)->whereIn('id', $id)->get();
        foreach ($ques as $q)
        {
            if ($q->correct_answer == $q->solution->answer) {
                echo $q->correct_answer.'matched';
            } else {
                echo $q->correct_answer;
                echo $q->solution->answer;
            }
        }
        /*ExamAnswer::whereIn('', $ques)->get();*/
/*       $runs = ExamAnswer::whereHas('question', function ($query) use ($ques) {
            $query->where('answer', $ques->correct_answer);
        })->get();
       dd($runs);*/
    }
}
