<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Hash;
use App\Models\Section;
use App\Models\Question;

class SectionController extends Controller
{
    /** 初期動作 */
    public function __construct() {}

    /** */
    public function home()
    {
        return view('sections.home');
    }


    /** 一覧 */
    public function index(Request $request)
    {
        // subjectが指定されていない場合はsections.homeにリダイレクト
        if (!$request->has('subject')) {
            return to_route('sections.home');
        }

        // subjectが指定されている場合のみフィルタリングを適用
        $subject = $request->subject;
        $sections = Section::where('subject', $subject)->get();

        return view('sections.index', compact('subject', 'sections'));
    }

    /** 新規作成画面 */
    public function create(Request $request)
    {
        $subjects = ['英語', '数学', '国語', '理科', '社会'];
        $currentSubject = $request->subject;

        return view('sections.create', compact('subjects', 'currentSubject'));
    }


    /** 新規作成処理 */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'subject' => 'required|in:英語,数学,国語,理科,社会',
            'number' => 'required|integer',
            'name' => 'required|string',
        ]);

        // 新規登録
        Section::create([
            'subject' => $request->subject,
            'number' => $request->number,
            'name' => $request->name,
        ]);

        // リダイレクト
        return to_route('sections.index', ['subject' => $request->subject])->with('success', '新しい単元が追加されました');
    }



    /** 詳細表示 */
    public function show($id)
    {
        $section = Section::findOrFail($id);
        $questions = Question::where('section_id', $id)->get();
        return view('sections.show', compact('section', 'questions'));
    }



    /** 編集画面 */
    public function edit() {}


    /** 編集処理 */
    public function update() {}

    /** 削除 */
    public function destroy() {}
}
