<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Score;
use App\Models\Grade;
use App\Models\Record;
use App\Models\Section;
use App\Models\Question;

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
            'withdrawal_date' => 'nullable|date',
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
            'withdrawal_date' => $request->withdrawal_date,
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
            'withdrawal_date' => 'nullable|date',
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


    public function school(Request $request)
    {
        // 基本情報
        $SCORE_OBJ = [
            1 => '１学期中間',
            2 => '１学期期末',
            3 => '２学期中間',
            4 => '２学期期末',
            5 => '学年末',
        ];

        $GRADE_OBJ = [
            1 => '１学期',
            2 => '２学期',
            3 => '３学期',
            4 => '学年',
        ];

        $SUBJECT_NAMES = [
            '国語',
            '数学',
            '英語',
            '社会',
            '理科',
            '音楽',
            '美術',
            '保体',
            '技家',
        ];

        $SUBJECT_COLUMNS = [
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

        //生徒情報
        $student_id = $request->student_id;
        $student = Student::find($student_id);
        $grade = $request->query('grade');

        // 学年が指定されていない場合の処理
        if (!$grade) {
            return view('schools.index', [
                'message' => '学年を指定してください。',
                'scores' => [],
                'grades' => []
            ]);
        }

        //定期テストの点数取得
        $scores = Score::where('student_id', $student_id)
            ->where('grade', $grade)
            ->get();

        //内申点取得
        $grades = Grade::where('student_id', $student_id)
            ->where('grade', $grade)
            ->get();

        //画面表示
        return view('students.school', compact('student', 'scores', 'grades', 'SCORE_OBJ', 'GRADE_OBJ', 'SUBJECT_NAMES', 'SUBJECT_COLUMNS'));
    }


    public function record_subject(Request $request, $student_id)
    {
        // 生徒情報を取得
        $student = Student::findOrFail($student_id);

        // 指定された科目に関連するすべての単元を取得
        $subject = $request->subject;
        $sections = Section::where('subject', $subject)->orderBy('number')->get();

        // 各単元に対して生徒の解答記録を取得
        $records = Record::where('student_id', $student_id)
            ->whereIn('section_id', $sections->pluck('id'))
            ->get();

        return view('students.record_subject', compact('student', 'sections', 'records', 'subject'));
    }

    public function record_detail($student_id, $section_id)
    {
        // 生徒情報を取得
        $student = Student::findOrFail($student_id);

        // 単元情報を取得
        $section = Section::findOrFail($section_id);

        // 単元に関連する質問を取得
        $questions = Question::where('section_id', $section_id)->get();

        // 生徒の記録を取得
        $record = Record::where('student_id', $student_id)
            ->where('section_id', $section_id)
            ->first();

        // ビューにデータを渡す
        return view('students.record_detail', compact('student', 'section', 'questions', 'record'));
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
