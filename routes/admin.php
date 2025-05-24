<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Fee\FeeController;
use App\Http\Controllers\Fee\FeeInvoiceController;
use App\Http\Controllers\Fee\PaymentFeeController;
use App\Http\Controllers\Fee\ProcessingFeeController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\Parent\ParentController;
use App\Http\Controllers\Receipt\ReceiptStudentController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Stage\StageController;
use App\Http\Controllers\Student\GraduatedStudentController;
use App\Http\Controllers\Student\PromotionController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Teacher\SectionTeacherController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
        'auth:admin',
        'verified'
    ])
    ->group(function () {

        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

            Route::resources([
                'stage' => StageController::class,
                'grade' => GradeController::class,
                'section' => SectionController::class,
                'parent' => ParentController::class,
                'teacher' => TeacherController::class,
                'teacherSection' => SectionTeacherController::class,
                'student' => StudentController::class,
                'promotion' => PromotionController::class,
                'graduated' => GraduatedStudentController::class,
                'fee' => FeeController::class,
                'invoice' => FeeInvoiceController::class,
                'receipt' => ReceiptStudentController::class,
                'processing' => ProcessingFeeController::class,
                'payment' => PaymentFeeController::class,
                'subject' => SubjectController::class,
                'sessions' => SessionController::class,
                'library' => LibraryController::class,
                'settings' => SettingsController::class,
            ]);

            Route::post('/deleteAll', [GradeController::class, 'deleteAll'])->name('deleteAll');
            Route::post('/filterGrade', [GradeController::class, 'filterGrade'])->name('filterGrade');

            Route::get('getGrade/{id}', [SectionController::class, 'getGrade']);
            Route::get('getSection/{id}', [SectionController::class, 'getSection']);

            Route::post('/student/uploadAttachment', [StudentController::class, 'uploadAttachment'])->name('uploadAttachment');
            Route::get('/student/downloadAttachment/{studentName}/{fileName}', [StudentController::class, 'downloadAttachment'])->name('downloadAttachment');
            Route::post('/student/deleteAttachment', [StudentController::class, 'deleteAttachment'])->name('deleteAttachment');

            Route::post('/promotion/retreat', [PromotionController::class, 'retreat'])->name('promotion.retreat');

            Route::get('getFee/{id}', [FeeController::class, 'getFee']);

            Route::get('/getSpecialization/{id}', [SubjectController::class, 'getSpecialization']);
            Route::get('getGrade/{id}', [SectionController::class, 'getGrade']);
            Route::get('getSection/{id}', [SectionController::class, 'getSection']);
            Route::get('sessions/indirect', [SessionController::class, 'indirectSession'])->name('sessions.indirectSession');
            Route::post('indirect/store', [SessionController::class, 'indirectSessionStore'])->name('indirect.indirectSessionStore');
            Route::get('/zoom/authorize', [SessionController::class, 'redirectToZoom'])->name('zoom.authorize');
            Route::get('/zoom/callback', [SessionController::class, 'handleZoomCallback'])->name('zoom.callback');

            Route::get('libraries/download/{id}', [LibraryController::class, 'download'])->name('libraries.download');
            Route::get('libraries/list', [LibraryController::class, 'getLibraries'])->name('libraries.list');
        });
    });
