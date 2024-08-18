<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user=User::firstOrCreate([
            'id'=>1
        ],[
            'id'=>1,
            'name'=>'Admin',
            'email'=>'admin@m.com',
            'password'=>bcrypt('password'),
        ]);

        $user->assignRole('admin');



        $user=User::firstOrCreate([
            'id'=>2
        ],[
            'id'=>2,
            'name'=>'User',
            'email'=>'user@m.com',
            'password'=>bcrypt('password'),
        ]);

        $user->assignRole('user');
    }
}
