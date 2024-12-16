<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = DB::table('majors')->pluck('id')->toArray();
        $classrooms = DB::table('classroom')->pluck('id')->toArray();

        $studentsData = [
            [
                'external_id' => 'S-PASYA',
                'full_name' => 'Pasya Student',
                'password' => 'pasya123',
            ],
            [
               'external_id' => 'S-HEIKAL',
               'full_name' => 'Heikal Student',
               'password' => 'heikal123',
           ],
           [
               'external_id' => 'S-HANS',
               'full_name' => 'Hans Student',
               'password' => 'hans123',
           ],
           [
               'external_id' => 'S-NATHA',
               'full_name' => 'Natha Student',
               'password' => 'natha123',
           ],
        ];

         foreach ($studentsData as $student) {
            $userId = DB::table('users')->insertGetId([
                'name' =>  explode(' ', $student['full_name'])[0],
                'password' => Hash::make($student['password']),
                'role' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
              
              $randomMajorId = $majors[array_rand($majors)];
              $randomClassroomId = $classrooms[array_rand($classrooms)];


            Student::insert([
               [
                    'user_id' => $userId,
                    'external_id' => $student['external_id'],
                    'full_name' => $student['full_name'],
                    'major_id' => $randomMajorId,
                    'classroom_id' =>  $randomClassroomId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
         }
    }
}