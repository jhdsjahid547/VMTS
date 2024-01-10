<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageResultController extends Controller
{
    public $question, $results;
    public function examlist(Request $request)
    {
        $this->question = Exam::where([['user_id', Auth::id()], ['activity', 1]])->get();
        if($request->ajax()) {
            return datatables()->of($this->question)
                ->addColumn('action', 'action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('creator.exam-list');
    }

    public function publish($id)
    {
        $this->question = Exam::resultPublish($id);
        return response()->json(['success' => $this->question]);
    }

    public function rank($id)
    {
        $this->results = ExamAttempt::where('exam_id', $id)->orderBy('result', 'desc')->get();
        return view('creator.rank', ['results' => $this->results]);
    }
}
