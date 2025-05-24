<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function fromStages()
    {
        return $this->belongsTo(Stage::class, 'fromStage');
    }

    public function toStages()
    {
        return $this->belongsTo(Stage::class, 'toStage');
    }

    public function fromGrades()
    {
        return $this->belongsTo(Grade::class, 'fromGrade');
    }

    public function toGrades()
    {
        return $this->belongsTo(Grade::class, 'toGrade');
    }

    public function fromSections()
    {
        return $this->belongsTo(Section::class, 'fromSection');
    }

    public function toSections()
    {
        return $this->belongsTo(Section::class, 'toSection');
    }
}
