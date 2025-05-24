<?php

namespace App\Repository\Classes\Teacher\Section;

use App\Models\Section;
use App\Repository\Interfaces\Teacher\Section\SectionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
        $langFile = 'datatables'; // Language file name without the language prefix
        $translations = Lang::get($langFile);
        $sectionIds = DB::table("section_teacher")->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $sectionIds)->get();
        return view('Pages.Teacher.Section.index', compact('sections', 'translations'));
    }
}
