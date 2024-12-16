<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $classrooms = DB::table('classroom')->get();

         foreach ($classrooms as $classroom) {
           for($i = 1; $i <= 2; $i++){
            $teacherName = 'guru-' . strtolower(str_replace(' ', '-', $classroom->name)) . '-' . $i;
            $teacher = Teacher::create([
                'user_id' => DB::table('users')->insertGetId([
                    'name' => $teacherName,
                    'password' => Hash::make('teacher'),
                    'role' => 'teacher',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]),
                'external_id' => 'T-' . strtoupper(str_replace(' ', '', $classroom->name)) .'-' .$i,
                'full_name' => 'Guru ' . $classroom->name . ' ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('teacher_majors')->insert([
                'teacher_id' => $teacher->user_id,
                'major_id' => $classroom->major_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
       }
    }
}