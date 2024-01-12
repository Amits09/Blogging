<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Category 1'],
            ['name' => 'Category 2'],
            ['name' => 'Category 3'],
            ['name' => 'Category 4'],
            ['name' => 'Category 5'],
            ['name' => 'Category 6'],
            ['name' => 'Category 7'],
            ['name' => 'Category 8'],
            ['name' => 'Category 9'],
            ['name' => 'Category 10'],
            // Add more categories as needed
        ];

        DB::table('categories')->insert($categories);
    }
}
