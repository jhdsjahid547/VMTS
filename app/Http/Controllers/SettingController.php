<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public $setting, $validCheck, $modres;
    public function index(Request $request)
    {
/*        if ($request->ajax()) {
            $this->setting = Setting::all();
            return response()->json(['success' => $this->setting]);
        }*/
        return view('admin.setting', ['setting' => Setting::all()]);
    }
    public function create(Request $request)
    {
        $this->validCheck = Validator::make($request->all(), [
            'title' => 'min:3|unique:settings,title',
        ]);
        if ($this->validCheck->passes()) {
            $this->modres = Setting::createSetting($request);
            return response()->json(['setting' => $this->modres, 'success' => 'Successfully setting created']);
        }
        return response()->json(['invalid' => $this->validCheck->errors()]);
    }
    public function update(Request $request, $id)
    {
        $this->setting = Setting::find($id);
        $this->setting->title = $request->title;
        $this->setting->save();

        return response()->json(['success' => 'Successfully setting updated']);
    }
    public function list()
    {
        return datatables()->of(Setting::all())
            ->addColumn('action', 'admin.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
    public function settingValue()
    {
        return 'hello';
    }
}
