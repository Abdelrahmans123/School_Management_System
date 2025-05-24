<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;


class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword, HasTranslations;
    public $translatable = ['name'];

    protected $guarded = 'student';
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthDate',
        'academicYear',
        'gender_id',
        'nationality_id',
        'bloodType_id',
        'stage_id',
        'grade_id',
        'section_id',
        'parent_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function stages()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function nationalities()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function guardians()
    {
        return $this->belongsTo(Guardian::class, 'guardian_id');
    }
    public function studentAccount()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}
