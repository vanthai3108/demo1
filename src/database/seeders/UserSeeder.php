<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 1 account admin + training staff
        $user = User::create([
            'username' => 'admin',
            'password' => Hash::make('adminadmin'),
            'fullname' => 'Admin 1',
            'email' => 'admin@gmail.com',
            'avatar' => 'storage/avatars/avatar1.png'
        ]);
        $user->roles()->attach([1, 2]);

        // create 1 account admin
        $user = User::create([
            'username' => 'admin2',
            'password' => Hash::make('adminadmin'),
            'fullname' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'avatar' => 'storage/avatars/avatar2.png'
        ]);
        $user->roles()->attach([1]);

        //create 3 trainning staff
        for($i=1; $i<4; $i++){
            $user = User::create([
                'username' => 'training'.$i,
                'password' => Hash::make('adminadmin'),
                'fullname' => 'Training staff '.$i,
                'email' => 'training'.$i.'@gmail.com',
                'avatar' => 'storage/avatars/avatar'.($i+2).'.png',
                // 'avatar' => 'storage/avatars/avatar-default.png'
            ]);
            $user->roles()->attach(2);
        }

        //create 3 trainer
        for($i=1; $i<4; $i++){
            $user = User::create([
                'username' => 'trainer'.$i,
                'password' => Hash::make('adminadmin'),
                'fullname' => 'Trainer '.$i,
                'email' => 'trainer'.$i.'@gmail.com',
                'avatar' => 'storage/avatars/avatar'.$i.'.jpg'
                // 'avatar' => 'storage/avatars/avatar-default.png'
            ]);
            $user->roles()->attach(3);
        }

        //create 5 trainee
        for($i=1; $i<6; $i++){
            $user = User::create([
                'username' => 'trainee'.$i,
                'password' => Hash::make('adminadmin'),
                'fullname' => 'Trainee '.$i,
                'email' => 'trainee'.$i.'@gmail.com',
                'avatar' => 'storage/avatars/avatar'.($i+3).'.jpg'
                // 'avatar' => 'storage/avatars/avatar-default.png'
            ]);
            $user->roles()->attach(4);
        }
    }
}
