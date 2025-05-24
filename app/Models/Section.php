<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ["name", "stage_id", "grade_id", "status"];
    public $translatable = ['name'];
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'section_teachers', 'section_id', 'teacher_id');
    }
    public function stages()
    {
        return $this->belongsTo(Stage::class);
    }
}
