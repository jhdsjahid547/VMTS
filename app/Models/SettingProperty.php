<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingProperty extends Model
{
    use HasFactory;

    public static $settingProperty;

    public static function createSettingProperty($request)
    {
        self::$settingProperty = new SettingProperty();
        self::$settingProperty->setting_id = $request->setting_id;
        self::$settingProperty->value = $request->value;
        self::$settingProperty->save();
        return ['id' => self::$settingProperty->id, 'settingId' => self::$settingProperty->setting_id, 'value' => self::$settingProperty->value];
    }

    public static function updateSettingProperty($request)
    {
        self::$settingProperty = SettingProperty::find($request->id);
        self::$settingProperty->value = $request->value;
        self::$settingProperty->save();
        return ['id' => self::$settingProperty->id, 'settingId' => self::$settingProperty->setting_id, 'value' => self::$settingProperty->value];
    }
    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }
}
