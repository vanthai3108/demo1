<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin', 'description' => 'This is admin']);
        Role::create(['name' => 'Training staff', 'description' => 'This is straining staff']);
        Role::create(['name' => 'Trainer', 'description' => 'This is trainer']);
        Role::create(['name' => 'Trainee', 'description' => 'This is trainee']);
    }
}
