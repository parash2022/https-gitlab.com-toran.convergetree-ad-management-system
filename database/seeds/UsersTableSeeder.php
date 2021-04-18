<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed administrator
        $user = User::create([
            'name' => 'Lara',
            'email'      => 'admin@laraverge.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
        ]);

        $user->role()->attach([1]);

    }
}
