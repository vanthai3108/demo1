<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            TopicSeeder::class,
            ProfileSeeder::class,
        ]);
        
    }
}
