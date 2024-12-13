<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeders = [
            MajorSeeder::class,
            ClassroomSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
        ];

        foreach ($seeders as $seeder) {
            try {
                $this->call($seeder);
                $this->optimizeMemory();
                Log::info("Completed seeder: {$seeder}");
            } catch (\Exception $e) {
                Log::error("Failed seeding {$seeder}: " . $e->getMessage());
                throw $e;
            }
        }
    }

    /**
     * Optimize memory usage during seeding.
     */
    protected function optimizeMemory(): void
    {
        if (function_exists('gc_collect_cycles')) {
            gc_collect_cycles();
        }

        DB::connection()->disableQueryLog();

        if (function_exists('gc_mem_caches')) {
            gc_mem_caches();
        }

        // add memory usage logging
        if (function_exists('memory_get_usage')) {
            $memoryUsage = round(memory_get_usage() / 1024 / 1024, 2);
            Log::info('Memory usage: ' . $memoryUsage . 'MB');
        }
    }
}
