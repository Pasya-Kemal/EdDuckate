<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = DB::table('classroom')->get();

        foreach ($classrooms as $classroom) {
            Student::create([
                'user_id' => DB::table('users')->insertGetId([
                    'name' => 'student' . $classroom->name . ' ' . Str::random(5),
                    'password' => Hash::make('student'),
                    'role' => 'student',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]),
                'external_id' => 'S-' . strtoupper($classroom->name),
                'full_name' => 'Siswa ' . $classroom->name,
                'major_id' => $classroom->major_id,
                'classroom_id' => $classroom->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
