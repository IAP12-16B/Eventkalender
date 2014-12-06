<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use kije\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            echo 'Create user "root" with password "password"'.PHP_EOL;
            $user = new User();
            $user->benutzername = 'root';
            $user->ID = 1;
            $user->setPassword('password');
            $user->save();
            echo 'Done'.PHP_EOL;
        }
    }

}