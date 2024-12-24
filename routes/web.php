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
        Route::get('{teacher_id}', 'show')->name('show');
        Route::get('edit/{teacher_id}', 'edit')->name('edit');
        Route::put('update/{teacher_id}', 'update')->name('update');
        Route::delete('destroy/{teacher_id}', 'destroy')->name('destroy');
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
        Route::get('{student_id}', 'show')->name('show');
        Route::get('edit/{student_id}', 'edit')->name('edit');
        Route::put('update/{student_id}', 'update')->name('update');
        Route::delete('destroy/{student_id}', 'destroy')->name('destroy')->middleware('can:isAdmin');
        Route::get('school/{student_id}', 'school')->name('school');
        Route::get('record/{student_id}/subject/{subject}', 'record_subject')->name('record_subject');
        Route::get('record/{student_id}/section/{section_id}', 'record_detail')->name('record_detail');
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
        Route::get('{section_id}', 'show')->name('show');
        Route::get('edit/{section_id}', 'edit')->name('edit');
        Route::put('update/{section_id}', 'update')->name('update');
        Route::delete('destroy/{section_id}', 'destroy')->name('destroy');
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
    ->prefix('sections/{section_id}/questions')
    ->name('questions.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('{question_id}', 'show')->name('show');
        Route::get('edit/{question_id}', 'edit')->name('edit');
        Route::put('update/{question_id}', 'update')->name('update');
        Route::delete('destroy/{question_id}', 'destroy')->name('destroy');
    });
