<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Section;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 各セクションに対して3つの質問を追加
        $sections = Section::all();

        foreach ($sections as $section) {
            for ($i = 1; $i <= 3; $i++) {
                Question::create([
                    'section_id' => $section->id,
                    'question_text' => "これは{$section->name}のサンプル質問 {$i} です。",
                    'question_image' => null, // 画像を使用しない場合はnull
                    'number' => $i, // 質問番号は1から3まで
                    'choice1' => '選択肢1',
                    'choice2' => '選択肢2',
                    'choice3' => '選択肢3',
                    'choice4' => '選択肢4',
                    'correct_answer' => rand(1, 4), // 1～4のランダムな正解
                ]);
            }
        }
    }
}
