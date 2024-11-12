<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Question;

class SectionController extends Controller
{
    /** @var array 教科のリスト */
    private $subjects;

    /** 初期動作 */
    public function __construct()
    {
        $this->subjects = ['英語', '数学', '国語', '理科', '社会'];
    }

    /** ホーム画面 */
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
        $subjects = $this->subjects;
        $currentSubject = $request->subject;
        return view('sections.create', compact('subjects', 'currentSubject'));
    }

    /** 新規作成処理 */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'subject' => 'required|in:' . implode(',', $this->subjects),
            'number' => 'required|integer',
            'name' => 'required|string',
        ]);

        // 新規登録
        Section::create($request->only(['subject', 'number', 'name']));

        // リダイレクト
        return to_route('sections.index', ['subject' => $request->subject])
            ->with('success', '新しい単元が追加されました');
    }

    /** 詳細表示 */
    public function show($id)
    {
        $section = Section::findOrFail($id);
        $questions = Question::where('section_id', $id)->get();
        return view('sections.show', compact('section', 'questions'));
    }

    /** 編集画面 */
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $subjects = $this->subjects;

        return view('sections.edit', compact('section', 'subjects'));
    }

    /** 編集処理 */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'subject' => 'required|in:' . implode(',', $this->subjects),
            'number' => 'required|integer',
            'name' => 'required|string',
        ]);

        // 更新処理
        $section = Section::findOrFail($id);
        $section->update($request->only(['subject', 'number', 'name']));

        return to_route('sections.show', $section->id)
            ->with('success', '単元情報を更新しました');
    }

    /** 削除処理 */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        return to_route('sections.index', ['subject' => $section->subject])
            ->with('success', '単元が削除されました');
    }
}
