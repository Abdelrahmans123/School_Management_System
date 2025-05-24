<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function fees()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function stages()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    // establish the relationship between a fee and a grade
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
