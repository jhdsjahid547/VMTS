<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public $course, $courses, $validcheck;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return datatables()->of(Course::all())
                ->addColumn('action', 'action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.course');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $this->course  = Course::find($request->id);
        return Response()->json($this->course);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validcheck = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:courses,name,'.$request->id,
            'code' => 'required|numeric|min:3'
        ]);
        if($this->validcheck->passes()) {
            if ($request->filled('id')) {
                Course::updateCourse($request);
                return response()->json(['success' => 'Successfully course updated']);
            } else {
                Course::createCourse($request);
                return response()->json(['success' => 'Successfully course created']);
            }
        }
        return response()->json(['invalid' => $this->validcheck->errors()]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->course = Course::find($request->id);
        $this->course->delete();
        return response()->json(['success'=>'Successfully course deleted']);
    }
}
