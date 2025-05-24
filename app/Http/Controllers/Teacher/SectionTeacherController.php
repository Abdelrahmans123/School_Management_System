<?php

namespace App\Http\Controllers\Teacher;


use App\Http\Controllers\Controller;
use App\Repository\Interfaces\Teacher\TeacherSectionRepositoryInterface;


class SectionTeacherController extends Controller
{
   protected $teacherSection;
    public function __construct(TeacherSectionRepositoryInterface $teacherSectionInterface){
        $this->teacherSection=$teacherSectionInterface;
    }
    public function index()
    {
        return $this->teacherSection->index();
    }

}
