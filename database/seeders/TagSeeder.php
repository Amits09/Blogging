<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Tag 1'],
            ['name' => 'Tag 2'],
            ['name' => 'Tag 3'],
            ['name' => 'Tag 4'],
            ['name' => 'Tag 5'],
            ['name' => 'Tag 6'],
            ['name' => 'Tag 7'],
        ];

        DB::table('tags')->insert($tags);
    }
}
