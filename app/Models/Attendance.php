<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'stage_id', 'grade_id', 'section_id', 'teacher_id', 'date', 'status'];
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
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
