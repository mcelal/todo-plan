<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Developer::query()->create([
            'name'  => 'DEV1',
            'level' => 1
        ]);

        Developer::query()->create([
            'name'  => 'DEV2',
            'level' => 2
        ]);

        Developer::query()->create([
            'name'  => 'DEV3',
            'level' => 3
        ]);

        Developer::query()->create([
            'name'  => 'DEV4',
            'level' => 4
        ]);

        Developer::query()->create([
            'name'  => 'DEV5',
            'level' => 5
        ]);
    }
}
