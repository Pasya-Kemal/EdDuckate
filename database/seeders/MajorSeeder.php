<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Major::insert([
            ['name' => 'Rekayasa Perangkat Lunak', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Multimedia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teknik Komputer dan Jaringan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Animasi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Broadcasting', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
