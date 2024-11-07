<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'role' => 'admin',
                'family_name' => 'admin',
                'given_name' => 'example',
                'email_company' => 'admin@example.com',
                'phone_company' => null,
                'email_private' => null,
                'phone_private' => null,
                'birth_date' => '1980-01-01',
                'hire_date' => '2020-01-01',
                'retirement_date' => null,
                'status' => '稼働',
                'password' => Hash::make('adminpass'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'teacher',
                'family_name' => 'teacher',
                'given_name' => 'example',
                'email_company' => 'teacher@example.com',
                'phone_company' => null,
                'email_private' => null,
                'phone_private' => null,
                'birth_date' => '1990-01-01',
                'hire_date' => '2021-01-01',
                'retirement_date' => null,
                'status' => '稼働',
                'password' => Hash::make('teacherpass'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
