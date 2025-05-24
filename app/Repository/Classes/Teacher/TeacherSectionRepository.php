<?php
namespace App\Repository\Classes\Teacher;

use App\Models\SectionTeacher;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Teacher\TeacherSectionRepositoryInterface;


class TeacherSectionRepository implements TeacherSectionRepositoryInterface{
 public function index(){
  $langFile = 'datatables'; // Language file name without the language prefix
        $translations = Lang::get($langFile);
        $teacherSection=SectionTeacher::all();
        return view('Pages.Teacher.Section.index',compact('translations','teacherSection'));
 }
}
