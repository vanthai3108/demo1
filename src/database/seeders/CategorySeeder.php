<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Software Engineering', 'description' => 'This category includes courses in Software Engineering']);
        Category::create(['name' => 'AI Programming', 'description' => 'This category includes courses in AI Programming']);
        Category::create(['name' => 'Computer science', 'description' => 'This category includes courses in Computer science']);
        Category::create(['name' => 'Computer Engineering', 'description' => 'This category includes courses in Computer Engineering']);
        Category::create(['name' => 'Graphic Design', 'description' => 'This category includes courses in Graphic Design']);
        Category::create(['name' => 'Interior design', 'description' => 'This category includes courses in Interior design']);
        Category::create(['name' => 'Business Administration', 'description' => 'This category includes courses in Business Administration']);
    }
}
