<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            echo 'Create user "root" with password "password"'.PHP_EOL;
            $user = User::create(array('benutzername' => 'root', 'ID' => 1));
            $user->passwort = Hash::make('password');
            $user->save();
            echo 'Done'.PHP_EOL;
        }
    }

}