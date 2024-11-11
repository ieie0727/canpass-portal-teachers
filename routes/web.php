<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\QuestionController;

// 認証ルート
Auth::routes();

// ホーム画面のルート（認証が必要）
Route::get('/', [HomeController::class, 'index'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Teacher関連ルート
|--------------------------------------------------------------------------
| 講師に関するルート設定
| 認証が必要で、/teachersに関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(TeacherController::class)
    ->middleware('auth')
    ->prefix('teachers')
    ->name('teachers.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Student関連ルート
|--------------------------------------------------------------------------
| 生徒に関するルート設定
| 認証が必要で、/studentsに関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(StudentController::class)
    ->middleware('auth')
    ->prefix('students')
    ->name('students.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Section関連ルート
|--------------------------------------------------------------------------
| 単元（セクション）に関するルート設定
| 認証が必要で、/sectionsに関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(SectionController::class)
    ->middleware('auth')
    ->prefix('sections')
    ->name('sections.')
    ->group(function () {
        Route::get('/home', 'home')->name('home');
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Question関連ルート
|--------------------------------------------------------------------------
| 質問に関するルート設定
| 認証が必要で、/questionsに関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(QuestionController::class)
    ->middleware('auth')
    ->prefix('questions')
    ->name('questions.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });
