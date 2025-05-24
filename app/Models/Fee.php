<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Fee extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['title'];
    protected $guarded = [];
    // establish the relationship between a fee and a stage
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
