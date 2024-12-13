<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Record;
use App\Models\Score;
use App\Models\Grade;

class StudentController extends Controller
{
    /** 一覧 */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /** 新規作成画面 */
    public function create()
    {
        return view('students.create');
    }

    /** 新規作成処理 */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'family_name' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'birth_date' => 'required|date',
            'admission_date' => 'required|date',
            'status' => 'required|in:在籍,休塾,退塾',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 新規登録
        $student = Student::create([
            'family_name' => $request->family_name,
            'given_name' => $request->given_name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'admission_date' => $request->admission_date,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        //新規登録した生徒の「テスト点・内申点」に全部-1を入れる
        $this->createInitialScoresAndGrades($student->id);

        // リダイレクト
        return to_route('students.index')->with('success', '新規生徒を追加しました');
    }

    /** 詳細表示 */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    /** 編集画面 */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /** 編集処理 */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'family_name' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'birth_date' => 'required|date',
            'admission_date' => 'required|date',
            'status' => 'required|in:在籍,休塾,退塾',
        ]);

        // アップデート
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return to_route('students.show', $student->id)->with('success', '生徒情報を更新しました');
    }

    /** 削除 */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', '生徒情報を削除しました。');
    }


    /** サブ関数 */
    /**  新規登録した生徒の「テスト点・内申点」に全部-1を入れる */
    public function createInitialScoresAndGrades($studentId)
    {
        $subjects = [
            'japanese',
            'math',
            'english',
            'social',
            'science',
            'music',
            'art',
            'physical',
            'industrial',
        ];

        //各学年ごとに回す
        for ($grade = 1; $grade <= 3; $grade++) {
            //定期テストの登録
            for ($term = 1; $term <= 5; $term++) {
                $scoreData = [
                    'student_id' => $studentId,
                    'grade' => $grade,
                    'term' => $term,
                ];

                Score::create($scoreData);
            }

            //内申点の登録
            for ($term = 1; $term <= 4; $term++) {
                $gradeData = [
                    'student_id' => $studentId,
                    'grade' => $grade,
                    'term' => $term,
                ];

                Grade::create($gradeData);
            }
        }
    }
}
