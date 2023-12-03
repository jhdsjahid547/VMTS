<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public static $setting;
    public static function createSetting($request)
    {
        self::$setting = new Setting();
        self::$setting->title = $request->title;
        self::$setting->save();
        return ['id' => self::$setting->id, 'title' => self::$setting->title];
    }
    public function property()
    {
       return $this->hasMany(SettingProperty::class);
    }
}
