<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Record;
use App\Models\Section;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /** 初期動作 */
    public function __construct() {}



    public function byStudent($student_id, $subject)
    {
        // 生徒情報を取得
        $student = Student::findOrFail($student_id);

        // 指定された科目に関連するすべての単元を取得
        $sections = Section::where('subject', $subject)->orderBy('number')->get();

        // 各単元に対して学習記録があるかチェック
        $records = Record::where('student_id', $student_id)
            ->whereIn('section_id', $sections->pluck('id'))
            ->get()
            ->keyBy('section_id');

        return view('records.by_student', compact('student', 'sections', 'records', 'subject'));
    }


    /** 新規作成画面 */
    public function create() {}


    /** 新規作成処理 */
    public function store() {}


    /** 詳細表示 */
    public function show() {}


    /** 編集画面 */
    public function edit() {}


    /** 編集処理 */
    public function update() {}

    /** 削除 */
    public function destroy() {}
}
