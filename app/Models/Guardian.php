<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;


class Guardian extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword, HasTranslations;
    protected $guarded = 'parent';
    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'fatherName',
        'fatherIdNumber',
        'fatherPassportNumber',
        'fatherPhone',
        'fatherJob',
        'fatherNationalityId',
        'fatherBloodTypeId',
        'fatherReligionId',
        'fatherAddress',
        'motherName',
        'motherIdNumber',
        'motherPassportNumber',
        'motherPhone',
        'motherJob',
        'motherNationalityId',
        'motherBloodTypeId',
        'motherReligionId',
        'motherAddress',
    ];

    public $translatable = ['fatherName', 'fatherJob', 'motherName', 'motherJob'];
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


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
}
