<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User as User;

class UserSeeder extends Seeder
{
    public function run()
    {
        //DB::table('users')->truncate();
        
        for ($i = 0; $i < 10; $i++) {
            $user = new User;
                $user->name       = 'Garcom'.$i;
                $user->email      = 'garcom'.$i.'@gmail.com';
                $user->users_type = 1;
                $user->password   = bcrypt('123456');
            $user->save();
        }

        for ($i = 0; $i < 10; $i++) {
            $user = new User;
                $user->name       = 'Cozinha'.$i;
                $user->email      = 'cozinha'.$i.'@gmail.com';
                $user->users_type = 2;
                $user->password   = bcrypt('123456');
            $user->save();
        }
    }
}