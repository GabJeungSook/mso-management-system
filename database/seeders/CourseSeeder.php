<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'name' => 'Bachelor of Science in Computer Science (BSCS)',
            ],
            [
                'name' => 'Bachelor of Science in Information Technology (BSIT)',
            ],
            [
                'name' => 'Bachelor of Science in Information Systems (BSIS)',
            ],
            [
                'name' => 'Bachelor of Science in Industrial Technology (BSIT)',
            ],
            [
                'name' => 'Bachelor of Technical-Vocational Teacher Education (BTVTEd)',
            ],
            [
                'name' => 'Bachelor of Science in Civil Engineering (BSCE)',
            ],
            [
                'name' => 'Bachelor of Science in Computer Engineering (BSCPE)',
            ],
            [
                'name' => 'Bachelor of Science in Electronics Engineering (BSECE)',
            ],
        ]);
    }
}
