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
        $majors = DB::table('majors')->get();

        foreach ($majors as $major) {
            $teacher = Teacher::create([
                'user_id' => DB::table('users')->insertGetId([
                    'name' => 'teacher ' . $major->name . ' ' . Str::random(5),
                    'password' => Hash::make('password'),
                    'role' => 'teacher',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]),
                'external_id' => 'T-' . strtoupper($major->name),
                'full_name' => 'Guru ' . $major->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('teacher_majors')->insert([
                'teacher_id' => $teacher->user_id,
                'major_id' => $major->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
