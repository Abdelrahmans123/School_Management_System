<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.selection');
})->name('selection');
// Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login/{type}', [LoginController::class, 'loginForm'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware(['auth:student,teacher,admin,parent'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->guard('student')->check()) {
            return Redirect::route('student.dashboard');
        } elseif (auth()->guard('teacher')->check()) {
            return Redirect::route('teacher.dashboard');
        } elseif (auth()->guard('admin')->check()) {
            return Redirect::route('admin.dashboard');
        } elseif (auth()->guard('parent')->check()) {
            return Redirect::route('parent.dashboard');
        }
    })->name('dashboard');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student', 'verified']
    ],
    function () {
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle)
                ->middleware(['web', 'auth:student', 'verified']);
        });

        // your routes...
    }
);

require __DIR__ . '/auth.php';
