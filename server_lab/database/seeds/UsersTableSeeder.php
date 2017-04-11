<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            "name" => 'Saddam Almahali',
            "email"=> 'saddam.almahali@gmail.com',
            'password'=> Hash::make('password')
        ];

        User::create($user);
    }
}
