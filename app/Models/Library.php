<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    public function stages()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
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
}
