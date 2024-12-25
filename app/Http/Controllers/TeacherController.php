<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /** 一覧表示 */
    public function index()
    {
        $teachers = Teacher::withTrashed()->get();
        return view('teachers.index', compact('teachers'))->with('success', session('success'));
    }

    /** 新規作成画面 */
    public function create()
    {
        return view('teachers.create');
    }

    /** 新規作成処理 */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'family_name'      => 'required|string|max:255',
            'given_name'       => 'required|string|max:255',
            'role'             => 'required|in:teacher,admin',
            'status'           => 'required|in:稼働,休職,退職',
            'email_company'    => 'required|email|unique:teachers,email_company',
            'phone_company'    => 'nullable|string|max:20|unique:teachers,phone_company',
            'email_private'    => 'nullable|email|unique:teachers,email_private',
            'phone_private'    => 'nullable|string|max:20|unique:teachers,phone_private',
            'birth_date'       => 'required|date',
            'hire_date'        => 'required|date',
            'retirement_date'  => 'nullable|date|after_or_equal:hire_date',
            'meeting_url'      => 'nullable|url',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        // パラメータが渡されなかった場合はnullにする(nullableのカラムのみ)
        $fieldsToNullify = [
            'phone_company',
            'email_private',
            'phone_private',
            'retirement_date',
            'meeting_url',
        ];
        foreach ($fieldsToNullify as $field) {
            if (!isset($validated[$field])) {
                $validated[$field] = null;
            }
        }

        // パスワードをハッシュ化
        $validated['password'] = Hash::make($validated['password']);

        Teacher::create($validated);

        return to_route('teachers.index')->with('success', '講師を追加しました。');
    }

    /** 詳細表示 */
    public function show($teacher_id)
    {
        $teacher = Teacher::withTrashed()->findOrFail($teacher_id);
        return view('teachers.show', compact('teacher'));
    }

    /** 編集画面 */
    public function edit($teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        return view('teachers.edit', compact('teacher'));
    }

    /** 編集処理 */
    public function update(Request $request, $teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);

        $validated = $request->validate([
            'family_name'      => 'required|string|max:255',
            'given_name'       => 'required|string|max:255',
            'role'             => 'required|in:teacher,admin',
            'status'           => 'required|in:稼働,休職,退職',
            'email_company'    => 'required|email|unique:teachers,email_company,' . $teacher->id,
            'phone_company'    => 'nullable|string|max:20',
            'email_private'    => 'nullable|email|unique:teachers,email_private,' . $teacher->id,
            'phone_private'    => 'nullable|string|max:20',
            'birth_date'       => 'required|date',
            'hire_date'        => 'nullable|date',
            'retirement_date'  => 'nullable|date|after_or_equal:hire_date',
            'meeting_url'      => 'nullable|url',
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.show', $teacher_id)->with('success', '講師情報を更新しました。');
    }

    /** 削除 */
    public function destroy($teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        $teacher->update(['status' => "退職"]);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', '講師情報を削除しました。');
    }
}
