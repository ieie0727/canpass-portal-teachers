<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            // 英語
            ['subject' => '英語', 'number' => 1, 'name' => '基本文型'],
            ['subject' => '英語', 'number' => 2, 'name' => '時制'],
            ['subject' => '英語', 'number' => 3, 'name' => '助動詞'],
            ['subject' => '英語', 'number' => 4, 'name' => '受動態'],
            ['subject' => '英語', 'number' => 5, 'name' => '関係代名詞'],

            // 数学
            ['subject' => '数学', 'number' => 1, 'name' => '方程式'],
            ['subject' => '数学', 'number' => 2, 'name' => '関数'],
            ['subject' => '数学', 'number' => 3, 'name' => '確率'],
            ['subject' => '数学', 'number' => 4, 'name' => '数列'],
            ['subject' => '数学', 'number' => 5, 'name' => '微分積分'],

            // 国語
            ['subject' => '国語', 'number' => 1, 'name' => '古文文法'],
            ['subject' => '国語', 'number' => 2, 'name' => '漢字と語彙'],
            ['subject' => '国語', 'number' => 3, 'name' => '現代文読解'],
            ['subject' => '国語', 'number' => 4, 'name' => '古典文学'],
            ['subject' => '国語', 'number' => 5, 'name' => '漢詩'],

            // 理科
            ['subject' => '理科', 'number' => 1, 'name' => '力学'],
            ['subject' => '理科', 'number' => 2, 'name' => '化学反応'],
            ['subject' => '理科', 'number' => 3, 'name' => '生物の進化'],
            ['subject' => '理科', 'number' => 4, 'name' => '電磁気学'],
            ['subject' => '理科', 'number' => 5, 'name' => '天体'],

            // 社会
            ['subject' => '社会', 'number' => 1, 'name' => '日本史'],
            ['subject' => '社会', 'number' => 2, 'name' => '世界史'],
            ['subject' => '社会', 'number' => 3, 'name' => '地理'],
            ['subject' => '社会', 'number' => 4, 'name' => '政治経済'],
            ['subject' => '社会', 'number' => 5, 'name' => '倫理'],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
