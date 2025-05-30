<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptStudent extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
