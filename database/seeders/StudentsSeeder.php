<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // サンプルの生徒データを作成
        Student::create([
            'role' => 'admin',
            'family_name' => 'admin',
            'given_name' => 'example',
            'email' => 'admin@example.com',
            'birth_date' => '2005-04-01',
            'admission_date' => '2021-04-01',
            'password' => Hash::make('adminpass'),
        ]);

        Student::create([
            'role' => 'student',
            'family_name' => 'student',
            'given_name' => 'example',
            'email' => 'student@example.com',
            'birth_date' => '2006-05-15',
            'admission_date' => '2022-04-01',
            'password' => Hash::make('studentpass'),
        ]);
    }
}
