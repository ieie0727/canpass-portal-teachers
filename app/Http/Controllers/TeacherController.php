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
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    /** 新規作成画面 */
    public function create()
    {
        return view('teachers.create');
    }

    /** 新規作成処理 */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'family_name'      => 'required|string|max:255',
            'given_name'       => 'required|string|max:255',
            'role'             => 'required|in:teacher,admin',
            'status'           => 'required|in:稼働,休職,退職',
            'email_company'    => 'required|email|unique:teachers,email_company',
            'phone_company'    => 'nullable|string|max:20',
            'email_private'    => 'nullable|email|unique:teachers,email_private',
            'phone_private'    => 'nullable|string|max:20',
            'birth_date'       => 'required|date',
            'hire_date'        => 'nullable|date',
            'retirement_date'  => 'nullable|date|after_or_equal:hire_date',
            'meeting_url'      => 'nullable|url',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        // パスワードをハッシュ化
        $validated['password'] = Hash::make($validated['password']);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', '講師を追加しました。');
    }

    /** 詳細表示 */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    /** 編集画面 */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    /** 編集処理 */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

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

        return redirect()->route('teachers.show', $teacher->id)->with('success', '講師情報を更新しました。');
    }

    /** 削除 */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', '講師情報を削除しました。');
    }
}
