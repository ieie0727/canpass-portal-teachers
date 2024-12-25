<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /** 一覧 */
    public function index($section_id)
    {
        // 指定されたセクションに関連する質問を取得
        $section = Section::findOrFail($section_id);
        $questions = Question::where('section_id', $section_id)->get();

        return view('questions.index', compact('section', 'questions'));
    }

    /** 新規作成画面 */
    public function create($section_id)
    {
        $section = Section::findOrFail($section_id);
        $questions = Question::where('section_id', $section_id)->get();
        return view('questions.create', compact('section', 'questions'));
    }

    /** 新規作成処理 */
    public function store(Request $request, $section_id)
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
            'section_id' => $section_id,
            'question_text' => $request->question_text,
            'question_image' => $request->file('question_image')?->store('questions', 'public'), // 画像保存
            'number' => $request->number,
            'choice1' => $request->choice1,
            'choice2' => $request->choice2,
            'choice3' => $request->choice3,
            'choice4' => $request->choice4,
            'correct_answer' => $request->correct_answer,
        ]);

        return to_route('questions.index', ['section_id' => $section_id])
            ->with('success', '新しい問題が追加されました');
    }

    /** 詳細表示 */
    public function show($section_id, $id)
    {
        $section = Section::findOrFail($section_id);
        $question = Question::where('section_id', $section_id)->findOrFail($id);

        return view('questions.show', compact('section', 'question'));
    }

    /** 編集画面 */
    public function edit($section_id, $id)
    {
        $section = Section::findOrFail($section_id);
        $question = Question::where('section_id', $section_id)->findOrFail($id);

        return view('questions.edit', compact('section', 'question'));
    }

    /** 編集処理 */
    public function update(Request $request, $section_id, $question_id)
    {
        // バリデーション
        $request->validate([
            'question_text' => 'required|string',
            'number' => 'required|integer',
            'choice1' => 'required|string',
            'choice2' => 'required|string',
            'choice3' => 'required|string',
            'choice4' => 'required|string',
            'correct_answer' => 'required|integer|in:1,2,3,4',
            'question_image' => 'nullable|image|max:2048',
        ]);

        $question = Question::findOrFail($question_id);

        // 画像削除の処理
        if ($request->has('delete_question_image') && $question->question_image) {
            Storage::delete('public/' . $question->question_image);
            $question->question_image = null;
        }

        // アップロードされた新しい画像を保存
        if ($request->hasFile('question_image')) {
            if ($question->question_image) {
                Storage::delete('public/' . $question->question_image); // 古い画像を削除
            }
            $path = $request->file('question_image')->store('questions', 'public');
            $question->question_image = $path;
        }

        // 他のフィールドを更新
        $question->update([
            'question_text' => $request->question_text,
            'number' => $request->number,
            'choice1' => $request->choice1,
            'choice2' => $request->choice2,
            'choice3' => $request->choice3,
            'choice4' => $request->choice4,
            'correct_answer' => $request->correct_answer,
        ]);

        return redirect()->route('questions.show', ['section_id' => $section_id, 'question_id' => $question->id])
            ->with('success', '問題を更新しました');
    }


    /** 削除 */
    public function destroy($section_id, $id)
    {
        $question = Question::where('section_id', $section_id)->findOrFail($id);

        // 画像がある場合は削除
        if ($question->question_image) {
            Storage::disk('public')->delete($question->question_image);
        }

        $question->delete();

        return to_route('sections.show', $section_id)
            ->with('success', '問題が削除されました');
    }
}
