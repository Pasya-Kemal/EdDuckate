<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = DB::table('majors')->get();

        foreach ($majors as $major) {
            Classroom::insert([
                ['name' => 'Kelas 10 ' . $major->name, 'major_id' => $major->id, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Kelas 11 ' . $major->name, 'major_id' => $major->id, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Kelas 12 ' . $major->name, 'major_id' => $major->id, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}