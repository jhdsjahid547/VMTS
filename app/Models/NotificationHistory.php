<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NotificationHistory extends Model
{
    use HasFactory;
    private static $history;
    public static function addToHistory($request, $path)
    {
        self::$history = new NotificationHistory();
        self::$history->user_id = Auth::id();
        self::$history->message = $request->message;
        if ($request->hasFile('attach')) {
            self::$history->file_path = $path;
        }
        self::$history->save();
    }
    public function url()
    {
        return Storage::url($this->file_path);
    }
}
