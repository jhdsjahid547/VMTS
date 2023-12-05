<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SettingProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public $setting, $settingProperty, $validCheck, $modres;
    public function index(Request $request)
    {
/*        if ($request->ajax()) {
            $this->setting = Setting::all();
            return response()->json(['success' => $this->setting]);
        }*/
        return view('admin.setting', ['setting' => Setting::all()]);
    }
/*    public function create(Request $request)
    {
        $this->validCheck = Validator::make($request->all(), [
            'title' => 'min:3|unique:settings,title',
        ]);
        if ($this->validCheck->passes()) {
            $this->modres = Setting::createSetting($request);
            return response()->json(['setting' => $this->modres, 'success' => 'Successfully setting created']);
        }
        return response()->json(['invalid' => $this->validCheck->errors()]);
    }*/
    // Update setting
    public function update(Request $request, $id)
    {
        $this->validCheck = Validator::make($request->all(), [
            'title' => 'required|min:3|unique:settings,title,'.$id,
        ]);
        if ($this->validCheck->passes()) {
            $this->setting = Setting::find($id);
            $this->setting->title = $request->title;
            $this->setting->save();
            return response()->json(['success' => 'Successfully setting updated']);
        }
        return response()->json(['invalid' => $this->validCheck->errors()]);
    }
/*    public function list()
    {
        return datatables()->of(Setting::all())
            ->addColumn('action', 'admin.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }*/
    // Property create and delete
    public function settingPropertyCreate(Request $request)
    {
        $this->validCheck = Validator::make($request->all(), [
            'value' => 'min:3',
        ]);
        if ($this->validCheck->passes()) {
            if ($request->setting == 'update') {
                $this->settingProperty = SettingProperty::updateSettingProperty($request);
                return response()->json([
                    'success' => $this->settingProperty,
                    'identity'=> 'update',
                    'message' => 'Successfully value updated'
                ]);
            } else {
                $this->settingProperty = SettingProperty::createSettingProperty($request);
                return response()->json([
                    'success' => $this->settingProperty,
                    'message' => 'Successfully value created'
                ]);
            }
        }
        return response()->json(['invalid' => $this->validCheck->errors()]);
    }
    public function propertyDestroy($id)
    {
        SettingProperty::find($id)->delete();
        return response()->json(['success' => 'Successfully value deleted']);
    }
}
