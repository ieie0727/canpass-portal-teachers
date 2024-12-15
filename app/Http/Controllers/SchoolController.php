<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Score;
use App\Models\Student;


class SchoolController extends Controller
{
    // 定数として宣言
    public const SCORE_OBJ = [
        1 => '１学期中間',
        2 => '１学期期末',
        3 => '２学期中間',
        4 => '２学期期末',
        5 => '学年末',
    ];

    public const GRADE_OBJ = [
        1 => '１学期',
        2 => '２学期',
        3 => '３学期',
        4 => '学年',
    ];

    public const SUBJECT_NAMES = [
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

    public const SUBJECT_COLUMNS = [
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


    /** 初期動作 */
    public function __construct()
    {
        view()->share('SCORE_OBJ', self::SCORE_OBJ);
        view()->share('GRADE_OBJ', self::GRADE_OBJ);
        view()->share('SUBJECT_NAMES', self::SUBJECT_NAMES);
        view()->share('SUBJECT_COLUMNS', self::SUBJECT_COLUMNS);
    }



    /** 成績表示(学年ごと) */
    public function index($id, Request $request)
    {
        $student = Student::find($id);
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
        $scores = Score::where('student_id', $id)
            ->where('grade', $grade)
            ->get();

        //内申点取得
        $grades = Grade::where('student_id', $id)
            ->where('grade', $grade)
            ->get();

        //画面表示
        return view('schools.index', compact('student', 'scores', 'grades'));
    }
}
