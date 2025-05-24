<?php

use App\Http\Controllers\Parent\ParentController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Receipt\ReceiptStudentController;
use App\Http\Controllers\Student\AttendanceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Parent Routes
|--------------------------------------------------------------------------
|
| Here is where you can register parent routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "parent" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent', 'verified']
    ],
    function () {


        Route::prefix('parent')->name('parent.')->group(function () {
            Route::get('/dashboard', [ParentController::class, 'dashboard'])->name('dashboard');
            Route::get('/students', [ParentController::class, 'students'])->name('students');
            Route::get('/student/results/{student_id}', [ParentController::class, 'studentResults'])->name('student.results');
            Route::get('/student/attendance', [ParentController::class, 'studentAttendance'])->name('student.attendance');
            Route::post('/attendance/search', [ParentController::class, 'search'])->name('attendance.search');
            Route::get('/student/fee', [ParentController::class, 'studentFee'])->name('student.fee');
            Route::get('/receipt/{id}', [ParentController::class, 'receipt'])->name('receipt');
            Route::resource('profile', ProfileController::class);
        });
    }
);
