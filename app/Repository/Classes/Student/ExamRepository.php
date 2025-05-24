<?php

namespace App\Repository\Classes\Student;

use App\Models\Quiz;
use App\Repository\Interfaces\Student\ExamRepositoryInterface;
use Illuminate\Support\Facades\Lang;

class ExamRepository implements ExamRepositoryInterface
{
    public function index()
    {
        $langFile = 'datatables'; // Language file name without the language prefix
        $translations = Lang::get($langFile);
        $quizzes = Quiz::where('stage_id', auth()->user()->stage_id)->where('section_id', auth()->user()->section_id)->where('grade_id', auth()->user()->grade_id)->orderBy('id', 'DESC')->get();
        return view('Pages.Student.Exam.index', compact('quizzes', 'translations'));
    }
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        $student_id = auth()->user()->id;
        return view('Pages.Student.Exam.show', compact('quiz', 'student_id'));
    }
}
