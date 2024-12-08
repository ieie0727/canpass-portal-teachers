<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Record;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TeachersSeeder::class);
        $this->call(StudentsSeeder::class);
        $this->call(SectionsSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(RecordsSeeder::class);
    }
}
