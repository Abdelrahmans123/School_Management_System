<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    public function stages()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
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
