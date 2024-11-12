<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /** 一覧 */
    public function index($sectionId)
    {
        // 指定されたセクションに関連する質問を取得
        $section = Section::findOrFail($sectionId);
        $questions = Question::where('section_id', $sectionId)->get();

        return view('questions.index', compact('section', 'questions'));
    }

    /** 新規作成画面 */
    public function create($sectionId)
    {
        $section = Section::findOrFail($sectionId); // セクションの確認
        return view('questions.create', compact('section'));
    }

    /** 新規作成処理 */
    public function store(Request $request, $sectionId)
    {
        // バリデーション
        $request->validate([
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|max:2048', // 画像は任意
            'number' => 'required|integer',
            'choice1' => 'required|string|max:255',
            'choice2' => 'required|string|max:255',
            'choice3' => 'required|string|max:255',
            'choice4' => 'required|string|max:255',
            'correct_answer' => 'required|integer|between:1,4',
        ]);

        // 質問の作成
        Question::create([
            'section_id' => $sectionId,
            'question_text' => $request->question_text,
            'question_image' => $request->file('question_image')?->store('questions', 'public'), // 画像保存
            'number' => $request->number,
            'choice1' => $request->choice1,
            'choice2' => $request->choice2,
            'choice3' => $request->choice3,
            'choice4' => $request->choice4,
            'correct_answer' => $request->correct_answer,
        ]);

        return to_route('questions.index', ['sectionId' => $sectionId])
            ->with('success', '新しい問題が追加されました');
    }

    /** 詳細表示 */
    public function show($sectionId, $id)
    {
        $section = Section::findOrFail($sectionId);
        $question = Question::where('section_id', $sectionId)->findOrFail($id);

        return view('questions.show', compact('section', 'question'));
    }

    /** 編集画面 */
    public function edit($sectionId, $id)
    {
        $section = Section::findOrFail($sectionId);
        $question = Question::where('section_id', $sectionId)->findOrFail($id);

        return view('questions.edit', compact('section', 'question'));
    }

    /** 編集処理 */
    public function update(Request $request, $sectionId, $id)
    {
        // バリデーション
        $request->validate([
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|max:2048',
            'number' => 'required|integer',
            'choice1' => 'required|string|max:255',
            'choice2' => 'required|string|max:255',
            'choice3' => 'required|string|max:255',
            'choice4' => 'required|string|max:255',
            'correct_answer' => 'required|integer|between:1,4',
        ]);

        $question = Question::where('section_id', $sectionId)->findOrFail($id);

        // 画像を更新する場合は古い画像を削除して保存
        if ($request->hasFile('question_image')) {
            if ($question->question_image) {
                Storage::disk('public')->delete($question->question_image);
            }
            $question->question_image = $request->file('question_image')->store('questions', 'public');
        }

        // データを更新
        $question->update([
            'question_text' => $request->question_text,
            'number' => $request->number,
            'choice1' => $request->choice1,
            'choice2' => $request->choice2,
            'choice3' => $request->choice3,
            'choice4' => $request->choice4,
            'correct_answer' => $request->correct_answer,
        ]);

        return to_route('questions.show', ['sectionId' => $sectionId, 'id' => $question->id])
            ->with('success', '問題が更新されました');
    }

    /** 削除 */
    public function destroy($sectionId, $id)
    {
        $question = Question::where('section_id', $sectionId)->findOrFail($id);

        // 画像がある場合は削除
        if ($question->question_image) {
            Storage::disk('public')->delete($question->question_image);
        }

        $question->delete();

        return to_route('sections.show', $sectionId)
            ->with('success', '問題が削除されました');
    }
}
