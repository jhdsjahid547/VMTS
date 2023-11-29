<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static $student, $message;

    public static function status($request)
    {
        self::$student = User::find($request->id);
        if (self::$student->status == 1){
            self::$student->status = 0;
            self::$message = 'disable';
        } else {
            self::$student->status = 1;
            self::$message = 'active';
        }
        self::$student->save();
        return self::$message;
    }
    public static function studentCreate($request)
    {
        self::$student = new User();
        self::$student->assignRole('subscriber');
        self::$student->name = $request->name;
        self::$student->email = $request->email;
        self::$student->password = bcrypt('password');
        self::$student->status = $request->status;
        self::$student->save();
        return self::$student->id;
    }
    public static function teacherCreate($request)
    {
        self::$student = new User();
        self::$student->assignRole('creator');
        self::$student->name = $request->name;
        self::$student->email = $request->email;
        self::$student->password = bcrypt('password');
        self::$student->status = $request->status;
        self::$student->save();
        return self::$student->id;
    }
    public static function updateUser($request)
    {
        self::$student = User::find($request->id);
        self::$student->name = $request->name;
        self::$student->email = $request->email;
        if($request->password) {
            self::$student->password = bcrypt($request->password);
        }
        self::$student->status = $request->status;
        self::$student->save();
    }
    public function subj()
    {
        return $this->hasOne(AssignCourse::class);
    }
    public function topic()
    {
        return $this->belongsToMany(Course::class, 'assign_courses');
    }
}
