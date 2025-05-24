<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grade extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ["name", "stageId"];
    public $translatable = ['name'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
