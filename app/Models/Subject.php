<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Subject extends Model
{
    use HasFactory;
    use HasFactory, HasTranslations;
    public $translatable = ['name'];

    protected $guarded = [];
    public function stages()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
