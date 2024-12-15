<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SchoolController;

// 認証ルート
Auth::routes();

// ホーム画面のルート（認証が必要）
Route::get('/', [HomeController::class, 'index'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Teacher関連ルート
|--------------------------------------------------------------------------
| 講師に関するルート設定
| /teachersに関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(TeacherController::class)
    ->middleware(['auth', 'can:isAdmin'])
    ->prefix('teachers')
    ->name('teachers.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Student関連ルート
|--------------------------------------------------------------------------
| 生徒に関するルート設定
| /studentsに関連したルートをまとめています。
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
        Route::get('{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Section関連ルート
|--------------------------------------------------------------------------
| 単元（セクション）に関するルート設定
| /sectionsに関連したルートをまとめています。
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
        Route::get('{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Question関連ルート
|--------------------------------------------------------------------------
| 質問に関するルート設定
| /questionsに関連したルートをまとめています。
|--------------------------------------------------------------------------
*/

Route::controller(QuestionController::class)
    ->middleware('auth')
    ->prefix('sections/{sectionId}/questions')
    ->name('questions.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Record関連ルート
|--------------------------------------------------------------------------
| 成績や記録に関するルート設定
| /students/{student_id}/records/に関連したルートを設定しています。
|-------------------------------------------------------------------------- 
*/
Route::controller(RecordController::class)
    ->middleware('auth')
    ->name('records.')
    ->group(function () {
        Route::get('students/{student_id}/records/{subject}', 'byStudent')->name('by_student');
    });

/*
|--------------------------------------------------------------------------
| School関連ルート
|--------------------------------------------------------------------------
| 学校関連の情報に関するルート設定
| /schools に関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(SchoolController::class)
    ->middleware('auth')
    ->prefix('schools')
    ->name('schools.')
    ->group(function () {
        Route::get('{id}', 'index')->name('index'); // 一覧表示
    });
