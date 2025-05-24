<?php

use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Quiz\QuizController;
use App\Http\Controllers\Section\SectionController as SectionSectionController;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Teacher\Section\SectionController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register teacher routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "teacher" middleware group. Make something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher', 'verified']
    ],
    function () {
        // Livewire
        //     ::setUpdateRoute(function ($handle) {
        //         return Route::post('/livewire/update', $handle);
        //     });
        Route::prefix('teacher')->name('teacher.')->group(function () {
            Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
            Route::get('/attendance/report', [AttendanceController::class, 'report'])->name('attendance.report');
            // Route::resource('/attendance', AttendanceController::class);
            Route::post('/attendance/search', [AttendanceController::class, 'search'])->name('attendance.search');
            Route::get('/section', [SectionController::class, 'index'])->name('section.index');
            Route::get('sessions/indirect', [SessionController::class, 'indirectSession'])->name('sessions.indirectSession');
            Route::get('quiz/result/{id}', [QuizController::class, 'result'])->name('quiz.result');
            Route::post('quiz/result/restore', [QuizController::class, 'restore'])->name('quiz.restore');
            Route::resources([
                'attendance' => AttendanceController::class,
                'exam' => ExamController::class,
                'quiz' => QuizController::class,
                'question' => QuestionController::class,
                'sessions' => SessionController::class,
                'profile' => ProfileController::class,
            ]);
            Route::get('create/{id}', [QuestionController::class, 'create'])->name('question.customCreate');
            Route::get('getGrade/{id}', [SectionSectionController::class, 'getGrade']);
            Route::get('getSection/{id}', [SectionSectionController::class, 'getSection']);
            Route::get('/getStages/{id}', [QuizController::class, 'getStages']);
            Route::post('indirect/store', [SessionController::class, 'indirectSessionStore'])->name('indirect.indirectSessionStore');
            Route::get('/zoom/authorize', [SessionController::class, 'redirectToZoom'])->name('zoom.authorize');
            Route::get('/zoom/callback', [SessionController::class, 'handleZoomCallback'])->name('zoom.callback');
        });
    }
);
