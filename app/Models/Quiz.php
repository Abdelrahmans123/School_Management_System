<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Quiz extends Model
{
    use HasFactory;
    use HasFactory, HasTranslations;
    public $translatable = ['name'];
    public function stages()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function exams()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }
    public function degree()
    {
        return $this->hasMany(Degree::class, 'quiz_id');
    }
    public function subject()
{
    return $this->belongsTo(Subject::class, 'subject_id');
}

}
